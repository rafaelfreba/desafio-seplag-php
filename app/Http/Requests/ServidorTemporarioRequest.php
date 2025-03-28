<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServidorTemporarioRequest extends FormRequest
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
            //servidor efetivo
            'pessoa_id' => [request()->is('POST') ? 'nullable' : 'required','numeric','min:1'],
            'lot_data_admissao' => ['required','date'],
            'lot_data_demissao' => ['required','date','after_or_equal:lot_data_admissao'],
            //pessoa
            'pes_nome' => ['required','string','min:1','max:200'],
            'pes_data_nascimento' => ['required','digits:4','after: 1908', 'before:'. date('Y')],
            'pes_sexo' => ['required','string', 'max:9', Rule::in(['nasculino', 'feminino'])],
            'pes_mae' => ['required','string','min:1','max:200'],
            'pes_pai' => ['required','string','min:1','max:200'],
            //endereco pessoa
            'pes_end_tipo_logradouro' => ['required','string','min:1','max:50'],
            'pes_end_logradouro' => ['required','string','min:1','max:200'],
            'pes_end_numero' => ['required','numeric'],
            'pes_end_bairro' => ['required','string','min:1','max:100'],
            'pes_cid_nome' => ['required','string','min:1','max:100'],
            'pes_cid_uf' => ['required','string','min:1','max:2'],
            // //unidade
            // 'unid_nome' => ['required','string','min:1','max:200'],
            // 'unid_sigla' => ['required','string','min:1','max:20'],
            // //endereco unidade
            // 'un_end_tipo_logradouro' => ['required','string','min:1','max:50'],
            // 'un_end_logradouro' => ['required','string','min:1','max:200'],
            // 'un_end_numero' => ['required','numeric'],
            // 'un_end_bairro' => ['required','string','min:1','max:100'],
            // 'un_cid_nome' => ['required','string','min:1','max:100'],
            // 'un_cid_uf' => ['required','string','min:1','max:2'],
            //lotacao
            'lot_data_lotacao' => ['required','date'],
            'lot_data_remocao' => ['nullable','date'],
            'lot_portaria' => ['required','string','min:1','max:20'],
            //foto pessoa
            'fp_data' => ['required','date'],
            'fp_bucket' => ['required','string','min:1','max:100'],
            'fp_hash' => ['required','string','min:1','max:100']
        ];
    }
}
