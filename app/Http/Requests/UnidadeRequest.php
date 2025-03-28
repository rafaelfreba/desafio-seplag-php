<?php

namespace App\Http\Requests;

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
            'unid_nome' => ['required','string','min:1','max:200'],
            'unid_sigla' => ['required','string','min:1','max:20']
        ];
    }

    public function attributes()
    {
        return [
            'unid_nome' => 'Nome da Unidade',
            'unid_sigla' => 'Sigla da Unidade'
        ];
    }
}
