<?php

namespace App\Http\Requests\alunos;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required'], 
            'data_nascimento' => ['required'], 
            'cpf' => ['required', 'cpf'], 
            'matricula' => ['required'], 
            'logradouro' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'cep' => ['required'],
            'cidade' => ['required'],
            'idade_inicio_estudos' => ['required'], 
            'idade_escola_atual' => ['required'], 
            'nome_pai' => ['required'], 
            'escolaridade_pai' => ['required'], 
            'profissao_pai' => ['required'], 
            'nome_mae' => ['required'], 
            'escolaridade_mae' => ['required'], 
            'profissao_mae' => ['required'], 
            'num_irmaos' => ['required'], 
            'contato_responsavel' => ['required'],
            'mora_com' => ['required'],
            'historico_comum' => ['required'],
            'historico_especifico' => ['required'],
            'motivo_encaminhamento_aee' => ['required'],
            'escolaridade_atual_aluno' => ['required'],
            'avaliacao_geral_familiar' => ['required'],
            'avaliacao_geral_escolar' => ['required'],
            'anexos_laudos' => ['required'],
            'cid' => ['required'],
            'descricao_cid' => ['required'],
            'imagem' => ['required'],
            'gre_id' => 'required|exists:gres,id',
            'municipio_id' => 'required|exists:municipios,id',
            'escola_id' => 'required|exists:escolas,id',
        ];
            
       
    }

    public function messages(): array
    {
        return [
            
        ];
    }
}
