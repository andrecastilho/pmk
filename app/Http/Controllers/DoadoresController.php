<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Doadores;
use DB;


class DoadoresController extends Controller
{

    public function index()
    {
            return Inertia::render('Home', [
            'doadores' => Doadores ::all()
                    ->transform(function($doadores) {
                        return [
                            'id' =>   $doadores->id,
                            'nome'=> $doadores->nome,
                            'email'=> $doadores->email,
                            'cpf'=> $doadores->cpf,
                            'telefone'=> $doadores->telefone,
                            'dt_nascimento'=> $doadores->dt_nascimento,
                            'dt_cadastro'=> $doadores->dt_cadastro,
                            'intervalo_doacao'=> $doadores->intervalo_doacao,
                            'vl_doacao'=> $doadores->vl_doacao,
                            'forma_pagamento'=> $doadores->forma_pagamento,
                            'endereco'=> $doadores->endereco,
                            'info'=>'Sucesso'                        ];
                    }
                ),
            ]);
    }

    public function create(Doadores $doadores)
    {
        return Inertia::render('Create', [
            'intervalo_doacao' => $doadores->only(
                'Mensal',
                'Bimestral',
                'Semestral',
                'Anual'
            ),
        ]);
    }

    public function save(Request $request)
    {
        $matchThese =$request->all();
        Doadores::updateOrCreate($matchThese);

        return Inertia::render('Home', [
            'doadores' => Doadores::all()->map(function ($doadores) {
                return [
                    'id' => $doadores->id,
                    'name' => $doadores->name,
                    'email' => $doadores->email,
                    'cpf'=> $doadores->cpf,
                    'telefone'=> $doadores->telefone,
                    'dt_nascimento'=> $doadores->dt_nascimento,
                    'dt_cadastro'=> $doadores->dt_cadastro,
                    'intervalo_doacao'=> $doadores->intervalo_doacao,
                    'vl_doacao'=> $doadores->vl_doacao,
                    'forma_pagamento'=> $doadores->forma_pagamento,
                    'endereco'=> $doadores->endereco,
                    'edit_url' => route('doadores.edit', $doadores),
                ];
            }),
            'create_url' => route('doadores.index',['info'=>'Sucesso']),
        ]);
        return Redirect::route('doadores.index',['info'=>'Sucesso']);
    }
}