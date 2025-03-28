<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
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
            'unid_nome' => ['required', 'string', 'min:1', 'max:200'],
            'unid_sigla' => ['required', 'string', 'min:1', 'max:20'],
            'end_tipo_logradouro' => ['required', 'string', 'min:1', 'max:50'],
            'end_logradouro' => ['required', 'string', 'min:1', 'max:200'],
            'end_numero' => ['required', 'numeric'],
            'end_bairro' => ['required', 'string', 'min:1', 'max:100'],
            'cidade_id' => ['required', 'numeric', 'min:1', Rule::exists('cidades', 'id')]
        ];
    }

    public function attributes()
    {
        return [
            'unid_nome' => 'Nome da Unidade',
            'unid_sigla' => 'Sigla da Unidade',
            'end_tipo_logradouro' => 'Tipo de Logradouro',
            'end_logradouro' => 'Logradouro',
            'end_numero' => 'Número',
            'end_bairro' => 'Bairro',
            'cidade_id' => 'Id da cidade',
        ];
    }
}