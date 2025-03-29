<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EfetivoServidorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //servidor efetivo
            'se_matricula' => ['required', 'string', 'min:1', 'max:20'],
            //pessoa
            'pes_nome' => ['required', 'string', 'min:1', 'max:200'],
            'pes_data_nascimento' => ['required', 'date', 'after: 1908-01-01', 'before:' . date('Y-m-d')],
            'pes_sexo' => ['required', 'string', 'max:9', Rule::in(['masculino', 'feminino'])],
            'pes_mae' => ['required', 'string', 'min:1', 'max:200'],
            'pes_pai' => ['required', 'string', 'min:1', 'max:200'],
            //endereco pessoa
            'end_tipo_logradouro' => ['required', 'string', 'min:1', 'max:50'],
            'end_logradouro' => ['required', 'string', 'min:1', 'max:200'],
            'end_numero' => ['required', 'numeric'],
            'end_bairro' => ['required', 'string', 'min:1', 'max:100'],
            'cidade_id' => ['required', 'numeric', 'min:1', Rule::exists('cidades', 'id')],
            //unidade
            'unidade_id' => ['required', 'numeric', 'min:1', Rule::exists('unidades', 'id')],
            //lotacao
            'lot_data_lotacao' => ['required', 'date', 'before_or_equal:' . date('Y-m-d')],
            'lot_data_remocao' => ['nullable', 'date', 'after:lot_data_lotacao'],
            'lot_portaria' => ['required', 'string', 'min:1', 'max:20'],
            //foto pessoa
            'fp_data' => ['nullable', 'date'],
            'fp_bucket' => ['nullable', 'string', 'min:1', 'max:100'],
            'fp_hash' => ['nullable', 'string', 'min:1', 'max:100']
        ];
    }
}
