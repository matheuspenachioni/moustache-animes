<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::all();

        return view('status.index')->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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

        $statu = new Status();
        $statu->name = $request->input('name');
        $statu->description = $request->input('description');
        $statu->save();

        return redirect(route('status.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::find($id);

        if ($status) {
            return view('status.show')->with('status', $status);
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
        $status = Status::find($id);

        return view('status.edit')->with('status', $status);
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

        $status = Status::find($id);

        $status->name = $request->input('name');
        $status->description = $request->input('description');

        $status->save();

        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);

        $status->delete();

        return redirect(route('status.index'));
    }

    public static function getStatuss()
    {
        $status = Status::all();
        return $status;
    }

    public function getRules()
    {
        $rules = [
            'name' => 'required|max:100',
            'description' => 'required|max:400'
        ];
        return $rules;
    }

    public function getRulesMessages()
    {
        $msg = [
            'name.*' => 'Digite o nome do estúdio! Permitido até 50 caracteres',
            'description.*' => 'Digite o nome do estúdio! Permitido até 400 caracteres'
        ];
        return $msg;
    }
}
