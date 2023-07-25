<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animes = Anime::with('studio', 'statu')->paginate(10);

        return view('anime.index')->with('animes', $animes);
    }

    public function addToUserList(Request $request, $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return redirect(route('animes.index'))->with('error', 'Anime não encontrado');
        }

        // Adiciona o anime à lista do usuário
        $request->user()->animes()->attach($anime);

        return redirect(route('animes.index'))->with('success', 'Anime adicionado à sua lista');
    }

    public function userList(Request $request)
{
    // Pega os animes do usuário
    $animes = $request->user()->animes()->paginate(10);

    // Retorna a view da lista do usuário
    return view('anime.user_list')->with('animes', $animes);
}

public function removeFromUserList(Request $request, $id)
{
    $anime = Anime::find($id);

    if (!$anime) {
        return redirect(route('animes.user_list'))->with('error', 'Anime não encontrado');
    }

    // Remove o anime da lista do usuário
    $request->user()->animes()->detach($anime);

    return redirect(route('animes.user_list'))->with('success', 'Anime removido da sua lista');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studios = StudioController::getStudios();
        $status = StatusController::getStatuss();

        return view('anime.create')->with('studios', $studios)->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getRules());
        
        $anime = new Anime();
        $anime->title = $request->input('title');
        $anime->synopsis = $request->input('synopsis');

        if($request->image){
            $anime->image = $request->image->store('images');
         }

        $anime->watched = $request->input('watched');
        $anime->episodes = $request->input('episodes');
        $anime->source = $request->input('source');
        $anime->studio_id = $request->input('studio');
        $anime->statu_id = $request->input('statu');

        $anime->save();

        return redirect(route('animes.index'));
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
        
        if($anime){
            return view('anime.show')->with('anime', $anime);
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

        if($request->image){
            if($anime->image && Storage::exists($anime->image)){
                Storage::delete($anime->image);
            }

            $anime->image = $request->image->store('images');
         }

        $anime->episodes = $request->input('watched');
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

    public function decrementWatched($id)
    {
        $anime = Anime::find($id);

        if ($anime && $anime->watched > 0) {
            $anime->decrement('watched');
            $anime->save();
            
            return redirect(route('animes.user_list'));
        } else {
            return redirect(route('animes.user_list'));
        }
    }

    public function incrementWatched($id)
    {
        $anime = Anime::find($id);

        if ($anime && $anime->watched < $anime->episodes) {
            $anime->increment('watched');
            $anime->save();
            
            return redirect(route('animes.user_list'));
        } else {
            return redirect(route('animes.user_list'));
        }
    }

    public function getRules(){
        $rules = [
            'title' => 'required|max:100',
            'synopsis' => 'required|max:3000',
            'image' => 'required|mimes:jpg, jpeg, png',
            'watched' => 'required|numeric',
            'episodes' => 'required|numeric',
            'source' => 'required|max:30' 
        ];
        return $rules;
    }

    public function getRulesMessages(){
        $msg = [
            'title.*' => 'Digite o título da obra! Permitido até 50 caracteres',
            'synopsis.*' => 'Digite uma sinopse! Permitido até 400 caracteres',
            'image.*' => 'Apenas o formato jpg, jpeg e png são suportados',
            'watched.*' => 'Digite quantos episódios já assitiu! Permitido até 4 dígitos',
            'episodes.*' => 'Digite o total de episódios! Permitido até 4 dígitos',
            'source.*' => 'Digite a fonte da obra! Permitido até 30 caracteres'
        ];
        return $msg;
    }

}