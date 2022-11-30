<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studios = Studio::all();

        return view('studio.index')->with('studios', $studios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studio.create');
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
        
        $studio = new Studio();
        $studio->name = $request->input('name');
        $studio->description = $request->input('description');
        $studio->established = $request->input('established');

        if($request->image){
            $studio->image = $request->image->store('images');
         }

        $studio->save();

        return redirect(route('studios.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studio = Studio::find($id);
        
        if($studio){
            return view('studio.show')->with('studio', $studio);
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
        $studio = Studio::find($id);

        return view('studio.edit')->with('studio', $studio);
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
        
        $studio = Studio::find($id);
        
        $studio->name = $request->input('name');
        $studio->description = $request->input('description');
        $studio->established = $request->input('established');

        if($request->image){
            if($studio->image && Storage::exists($studio->image)){
                Storage::delete($studio->image);
            }

            $studio->image = $request->image->store('images');
         }
        
        $studio->save();
        
        return redirect()->route('studios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studio = Studio::find($id);
        
        $studio->delete();
        
        return redirect(route('studios.index'));
    }

    public static function getStudios(){
        $studios = Studio::all();
        return $studios;
    }

    public function getRules(){
        $rules = [
            'name' => 'required|max:100',
            'description' => 'required|max:400',
            'established' => 'required'
        ];
        return $rules;
    }

    public function getRulesMessages(){
        $msg = [
            'name.*' => 'Digite o nome do estúdio! Permitido até 50 caracteres',
            'description.*' => 'Digite o nome do estúdio! Permitido até 400 caracteres',
            'established.*' => 'Insira uma data válida'
        ];
        return $msg;
    }
}