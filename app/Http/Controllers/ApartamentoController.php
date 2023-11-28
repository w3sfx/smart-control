<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApartamentoController extends Controller
{
    public function index() {
        return Inertia::render('Apartamento/Cadastro');
    }

    public function store(Request $request) {
        $data = $request->all();

        $apartamento = new Apartamento;
        $apartamento->fill($data);
        $apartamento->save();        
    }
}
