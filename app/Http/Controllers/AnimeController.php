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
        $animes = Anime::with('studio')->paginate(10);

        return view('anime.index')->with('animes', $animes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studios = StudioController::getStudios();

        return view('anime.create')->with('studios', $studios);
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

        $anime->episodes = $request->input('episodes');
        $anime->source = $request->input('source');
        $anime->studio_id = $request->input('studio');

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

        return view('anime.edit')->with('anime', $anime)->with('studios', $studios);
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

        $anime->episodes = $request->input('episodes');
        $anime->source = $request->input('source');
        $anime->studio_id = $request->input('studio');
        
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

    public function getRules(){
        $rules = [
            'title' => 'required|max:100',
            'synopsis' => 'required|max:400',
            'image' => 'required|mimes:jpg, jpeg, png',
            'episodes' => 'required|numeric',
            'source' => 'required|max:30' 
        ];
        return $rules;
    }

    public function getRulesMessages(){
        $msg = [
            'title.*' => 'Digite o t??tulo da obra! Permitido at?? 50 caracteres',
            'synopsis.*' => 'Digite uma sinopse! Permitido at?? 400 caracteres',
            'image.*' => 'Apenas o formato jpg, jpeg e png s??o suportados',
            'episodes.*' => 'Digite o total de epis??dios! Permitido at?? 4 d??gitos',
            'source.*' => 'Digite a fonte da obra! Permitido at?? 30 caracteres'
        ];
        return $msg;
    }

}