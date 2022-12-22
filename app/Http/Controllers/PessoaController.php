<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Telefone;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PessoaController extends Controller
{
    /**
     * Verifica se o CPF é inválido
     * Verifica se já existe CPF cadastrado, se este possuir menos de 5 telefones
     * @param Request $request
     * @return array
     */
    public function storePessoa(Request $request)
    {
        try {
            DB::beginTransaction();
            //validação para verificar se todos os campos obrigatórios foram preenchidos
            $validator =    Validator::make(
                $request->all(),
                [
                'nome' => 'required',
                'cpf' => 'required',
                'endereco' => 'required'
            ],
                [
                    'nome.required' => 'O nome da pessoa é obrigatório',
                        'cpf.required' => 'O cpf da pessoa é obrigatório',
                        'endereco.required' => 'O endereço da pessoa é obrigatório'
                ]
            );



            if ($validator->fails()) {
                return ['msg' => 'Nome, CPF e Endereço são dados obrigatórios!','success' => false];
            }
            //Remoção de caracteres não numéricos
            $cpf = preg_replace('/[^0-9]/', '', $request->cpf);
            //verificação básica de cpf
            if (strlen($cpf) !== 11) {
                return ['msg' => 'Cpf inválido!','success' => false];
            }

            //verificação se a pessoa já foi cadastrada
            $cpfExists = Pessoa::where('cpf', $cpf)->get();
            if (count($cpfExists) > 0) {
                return ['msg' => 'Cpf já cadastrado!','success' => false];
            }

            //Criação da nova pessoa
            $newPessoa = Pessoa::create(
                ['nome' => $request->nome,
                 'cpf' => $cpf,
                 'endereco' => $request->endereco
                ]
            );

            //Associação da pessoa com os telefones vindos via Request

            foreach ($request->telefones as $keyTelefone => $telefoneValue) {
                foreach ($request->descricao as $keyDescricao => $descricaoValue) {
                    if ($keyDescricao == $keyTelefone && $telefoneValue !== null && $descricaoValue !== null) {
                        //Remoção de caracteres não numéricos
                        $tel = (preg_replace("/[^0-9]/", "", $telefoneValue));
                        $newPessoa->telefones()->create(
                            ['telefone' => preg_replace('/[^0-9]/', '', $telefoneValue),
                             'descricao' => $descricaoValue,
                            ]
                        );
                    }
                }
            }
            DB::commit();

            //retorno da requisição caso não existam erros durante o processo
            return ['msg' => 'Sucesso! Seus dados foram cadastrados','success' => true,'pessoa' => $newPessoa, 'telefones' =>$newPessoa->telefones];
        } catch(\Exception $e) {
            report($e);
            DB::rollBack();
            return ['msg' => 'Não foi possível gravar seus dados, contate o administrador do sistema!','success' => false];
        }
    }
}
