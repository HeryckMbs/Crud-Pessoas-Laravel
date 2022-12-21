<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    public function storePessoa(Request $request)
    {
        try {
            DB::beginTransaction();
            $cpf = preg_replace('/[^0-9]/', '', $request->cpf);
            $cpfExists = Pessoa::where('cpf', $cpf)->get();
            if (count($cpfExists) > 0) {
                return ['msg' => 'Cpf já cadastrado!','success' => false];
            }

            $newPessoa = Pessoa::create(['nome' => $request->nome, 'cpf' => $cpf]);
            foreach ($request->telefones as $keyTelefone => $telefoneValue) {
                foreach ($request->descricao as $keyDescricao => $descricaoValue) {
                    if ($keyDescricao == $keyTelefone && $keyTelefone !== null && $keyDescricao !== null) {
                        $newPessoa->telefones()->create(
                            ['telefone' => $telefoneValue,
                             'descricao' => $descricaoValue,
                            ]
                        );
                    }
                }
            }

            DB::commit();

            return ['msg' => 'Sucesso!','success' => true,'pessoa' => $newPessoa, 'telefones' =>$newPessoa->telefones];
        } catch(\Exception $e) {
            report($e);
            DB::rollBack();
        }
    }
}
