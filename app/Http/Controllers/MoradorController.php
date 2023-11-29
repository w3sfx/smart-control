<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\Morador;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MoradorController extends Controller
{
    public function index() {
        $apartamentos = Apartamento::all()->pluck('numero', 'id');

        return Inertia::render('Morador/Cadastro', [
            'apartamentos' => $apartamentos,
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();

        $morador = new Morador;
        $morador->nome = $data['morador'];
        $morador->apartamento_id = $data['apartamento']['id'];
        $morador->save();        
    }
}
