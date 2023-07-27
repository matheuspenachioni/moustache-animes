<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    /* Página que lista todos os Status */
    public function index()
    {
        $status = Status::all();

        return view('status.index')->with('status', $status);
    }

    /* Página com o formulário para um novo Status */
    public function create()
    {
        return view('status.create');
    }

    /* Método para persistência de dados */
    public function store(Request $request)
    {
        $request->validate($this->getRules());

        $status = new Status();
        $status->name = $request->input('name');
        $status->color = $request->input('color');
        $status->description = $request->input('description');
        $status->save();

        return redirect(route('status.index'));
    }

    /* Página com o formulário para editar um Status*/
    public function edit($id)
    {
        $status = Status::find($id);

        return view('status.edit')->with('status', $status);
    }

    /* Método para editar os dados*/
    public function update(Request $request, $id)
    {
        $request->validate($this->getRules());

        $status = Status::find($id);

        $status->name = $request->input('name');
        $status->color = $request->input('color');
        $status->description = $request->input('description');

        $status->save();

        return redirect()->route('status.index');
    }

    /* Método para deletar um Status */
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
            'color' => 'required|max:100',
            'description' => 'required|max:400'
        ];
        return $rules;
    }

    public function getRulesMessages()
    {
        $msg = [
            'name.*' => 'Digite o nome do status! Permitido até 100 caracteres',
            'color.*' => 'Digite a cor do status! Permitido até 100 caracteres',
            'description.*' => 'Digite a descrição do status! Permitido até 400 caracteres'
        ];
        return $msg;
    }
}
