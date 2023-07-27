<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    //...Página principal
    public function index(Request $request)
    {
        $search = $request->query('search');
        if ($search) {
            $animes = Anime::where(DB::raw('LOWER(title)'), 'LIKE', '%' . strtolower($search) . '%')
                ->with('studio', 'statu')
                ->paginate(10);
        } else {
            $animes = Anime::with('studio', 'statu')->paginate(8);
        }
    
        return view('anime.index')->with('animes', $animes);
    }

    //...Adicionar um anime a lista do usuário
    public function addToUserList(Request $request, $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return redirect(route('animes.index'))->with('error', 'O anime não foi encontrado!');
        }

        if ($request->user()->animes()->where('anime_id', $anime->id)->exists()) {
            return redirect(route('animes.index'))->with('error', $anime->title .' já está em sua lista!');
        }

        //Adiciona o anime à lista do usuário
        $request->user()->animes()->attach($anime);

        return redirect(route('animes.index'))->with('success', $anime->title .' foi adicionado à sua lista!');
    }

    //...Página da lista de animes do usuário
    public function userList(Request $request)
    {
        //Pega os animes do usuário e carrega os dados da tabela pivot
        $animes = $request->user()->animes()->withPivot('watched', 'rating')->paginate(8);

        // Retorna a view da lista do usuário
        return view('anime.user_list')->with('animes', $animes);
    }

    public function searchInUserList(Request $request)
    {
        $search = $request->query('search');

        //Pega os animes do usuário que correspondem à pesquisa e carrega os dados da tabela pivot
        $animes = $request->user()->animes()->where('title', 'LIKE', '%' . $search . '%')->withPivot('watched', 'rating')->paginate(8);

        // Retorna a view da lista do usuário com os animes da pesquisa
        return view('anime.user_list')->with('animes', $animes);
    }

    //Remove um anime da lista do usuário
    public function removeFromUserList(Request $request, $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return redirect(route('animes.user_list'))->with('error', 'O anime não foi encontrado!');
        }

        // Remove o anime da lista do usuário
        $request->user()->animes()->detach($anime);

        return redirect(route('animes.user_list'))->with('success', $anime->title .' foi removido da sua lista!');
    }

    //...Método que chama a view create e carrega Studios e Status
    public function create()
    {
        $studios = StudioController::getStudios();
        $status = StatusController::getStatuss();

        return view('anime.create')->with('studios', $studios)->with('status', $status);
    }

    //...Método que armazena os dados recebidos do input no db
    public function store(Request $request)
    {
        $request->validate($this->getRules());

        $anime = new Anime();
        $anime->title = $request->input('title');
        $anime->synopsis = $request->input('synopsis');
        $anime->score = $request->input('score');

        if ($request->image) {
            $anime->image = $request->image->store('images');
        }

        $anime->episodes = $request->input('episodes');
        $anime->source = $request->input('source');
        $anime->studio_id = $request->input('studio');
        $anime->statu_id = $request->input('statu');

        $anime->save();

        return redirect(route('animes.index'));
    }

    public function updateRating(Request $request, $id)
    {

        $anime = Anime::find($id);

        // Atualizar "score" na tabela pivot
        $request->user()->animes()->updateExistingPivot($anime, ['rating' => $request->rating]);

        return redirect(route('animes.user_list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anime = Anime::find($id);
        $comment = new Comment();

        if ($anime) {
            return view('anime.show')->with(['anime' => $anime, 'comment' => $comment]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anime = Anime::find($id);

        $studios = StudioController::getStudios();
        $status = StatusController::getStatuss();

        return view('anime.edit')->with('anime', $anime)->with('studios', $studios)->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getRules());

        $anime = Anime::find($id);

        $anime->title = $request->input('title');
        $anime->synopsis = $request->input('synopsis');
        $anime->score = $request->input('score');

        if ($request->image) {
            if ($anime->image && Storage::exists($anime->image)) {
                Storage::delete($anime->image);
            }

            $anime->image = $request->image->store('images');
        }

        $anime->episodes = $request->input('episodes');
        $anime->source = $request->input('source');
        $anime->studio_id = $request->input('studio');
        $anime->statu_id = $request->input('statu');

        $anime->save();

        return redirect(route('animes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anime = Anime::find($id);

        Storage::delete($anime->image);
        $anime->delete();

        return redirect(route('animes.index'));
    }

    public function editComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment || $comment->user_id != auth()->user()->id) {
            abort(404);
        }

        $anime = $comment->anime;

        return view('anime.show', compact('anime', 'comment'));
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment || $comment->user_id != auth()->user()->id) {
            abort(404);
        }

        $request->validate([
            'body' => 'required',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('animes.show', $comment->anime_id);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment || $comment->user_id != auth()->user()->id) {
            abort(404);
        }

        $comment->delete();

        return back();
    }

    public function updateWatched(Request $request, $id)
{
    // Validando a entrada
    $request->validate([
        'watched' => 'required|integer|min:0|max:' . Anime::find($id)->episodes,
    ]);

    // Encontre a entrada na tabela pivot para este anime e usuário
    $userAnime = $request->user()->animes()->where('anime_id', $id)->first();

    // Atualizar "watched" na tabela pivot
    $userAnime->pivot->update(['watched' => $request->watched]);

    return redirect(route('animes.user_list'));
}


    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $anime = Anime::findOrFail($id);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = $request->user()->id;

        $anime->comments()->save($comment);

        return back();
    }

    public function getRules()
    {
        $rules = [
            'title' => 'required|max:100',
            'synopsis' => 'required|max:3000',
            'score' => 'required|numeric|between:0,10',
            'image' => 'required|mimes:jpg, jpeg, png',
            'episodes' => 'required|numeric',
            'source' => 'required|max:30'
        ];
        return $rules;
    }

    public function getRulesMessages()
    {
        $msg = [
            'title.*' => 'Digite o título da obra! Permitido até 50 caracteres',
            'synopsis.*' => 'Digite uma sinopse! Permitido até 400 caracteres',
            'image.*' => 'Apenas o formato jpg, jpeg e png são suportados',
            'score.*' => 'Digite a nota da obra! Permitido até 4 dígitos',
            'episodes.*' => 'Digite o total de episódios! Permitido até 4 dígitos',
            'source.*' => 'Digite a fonte da obra! Permitido até 30 caracteres'
        ];
        return $msg;
    }
}
