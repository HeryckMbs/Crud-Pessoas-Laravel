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
            $cpf_exist = Pessoa::where('cpf', $cpf)->get();
            if (count($cpf_exist) > 0) {
                return ['msg' => 'Cpf já cadastrado!','success' => false];
            }
            if (strlen($cpf) !== 11) {
                return ['msg' => 'Cpf inválido!','success' => false];
            }

            //verificação se a pessoa já foi cadastrada

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
                        $telformart = (preg_replace("/[^0-9]/", "", $telefoneValue));
                        $newPessoa->telefones()->create(
                            ['telefone' => $telformart,
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

    public function deletePessoa(int $idPessoa)
    {
        try {
            $pessoa = Pessoa::findOrFail($idPessoa);
            DB::beginTransaction();
            $pessoa->telefones()->delete();
            $pessoa->delete();
            DB::commit();
            return ['msg' => 'Pessoa excluída com sucesso!', 'success' => true];
        } catch(\Exception $e) {
            report($e);
            DB::rollBack();
            return ['msg' => 'Ocorreu um erro ao excluir a pessoa desejada, por favor tente novamente!', 'success' => false];
        }
    }

    public function getPessoa(int $id)
    {
        try {
            $pessoa = Pessoa::findOrFail($id)->with(['telefones'])->first();
            return ['msg' => '', 'pessoa' =>$pessoa,'success' => true];
        } catch(\Exception $e) {
            return ['msg' => 'Não foi possível buscar a pessoa', 'success' => false];
        }
    }

    public function updatePessoa(Request $request, $id)
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


            $pessoaCadastrada = Pessoa::findOrFail($id);
            $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

            $pessoaCadastrada->update([
                'nome' => $request->nome,
                'cpf' => $cpf,
                'endereco' => $request->endereco
            ]);


            $pessoaCadastrada->save();

            foreach ($request->telefones as $keyTelefone => $telefoneValue) {
                foreach ($request->descricao as $keyDescricao => $descricaoValue) {
                    if ($keyDescricao == $keyTelefone && $telefoneValue !== null && $descricaoValue !== null) {
                        //Remoção de caracteres não numéricos
                        $telefoneUpdate = Telefone::where('telefone', '=', $telefoneValue)->first();
                        if ($telefoneUpdate !== null) {
                            $tel = (preg_replace("/[^0-9]/", "", $telefoneValue));
                            $telefoneUpdate->telefone = $tel;
                            $telefoneUpdate->descricao = $descricaoValue;
                            $telefoneUpdate->save();
                        } else {
                            $pessoaCadastrada->telefones()->create(
                                ['telefone' => preg_replace('/[^0-9]/', '', $telefoneValue),
                                 'descricao' => $descricaoValue,
                                ]
                            );
                        }
                    }
                }
            }
            DB::commit();
            return ['msg' => 'Usuário atualizado!','success' => true, 'edit' => true, 'pessoa' => $pessoaCadastrada, 'telefones' => $pessoaCadastrada->telefones];
        } catch(\Exception $e) {
            DB::rollBack();
            return ['msg' => 'Ocorreu um erro ao excluir a pessoa desejada, por favor tente novamente!', 'success' => false];
        }
    }
}
