<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VisitanteController extends Controller
{
    public function index() {
        $visitante = Visitante::all();

        return Inertia::render('Visitante/Index', [
            'visitante' => $visitante
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();

        $morador = new Visitante;
        $morador->tipo = $data['tipo']['id'];
        $morador->nome = $data['nome'];
        $morador->descricao = $data['descricao'];
        $morador->status = 0;
        $morador->data_entrada = date('Y-m-d H:i:s');
        $morador->save();        
    }
}
