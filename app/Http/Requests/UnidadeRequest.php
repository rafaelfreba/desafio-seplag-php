<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unid_nome' => ['required', 'string', 'min:1', 'max:200'],
            'unid_sigla' => ['required', 'string', 'min:1', 'max:20'],
            'end_tipo_logradouro' => ['required', 'string', 'min:1', 'max:50'],
            'end_logradouro' => ['required', 'string', 'min:1', 'max:200'],
            'end_numero' => ['required', 'numeric'],
            'end_bairro' => ['required', 'string', 'min:1', 'max:100'],
            'cid_id' => ['required', 'numeric', 'min:1', Rule::exists('cidade', 'cid_id')]
        ];
    }
}