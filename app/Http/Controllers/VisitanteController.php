<?php

namespace App\Http\Controllers;

use App\Models\Morador;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VisitanteController extends Controller
{
    public function index() {
        $visitante = Visitante::orderBy('status')->get();
        $morador = Morador::all();

        return Inertia::render('Visitante/Index', [
            'visitante' => $visitante,
            'morador' => $morador
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();

        $visitante = new Visitante;
        $visitante->tipo = $data['tipo']['id'];
        $visitante->nome = $data['nome'];
        $visitante->descricao = $data['descricao'];
        $visitante->status = 0;
        $visitante->data_entrada = date('Y-m-d H:i:s');
        $visitante->morador = $data['morador']['id'];
        $visitante->save();        
    }

    public function saida(Request $request) {
        $data = $request->all()['data'];
        
        $visitante = Visitante::where('id', $data['id'])->first();
        $visitante->data_saida = date('Y-m-d H:i:s');
        $visitante->status = 1;
        $visitante->save();
    }
}
