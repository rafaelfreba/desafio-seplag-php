<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LotacaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pes_id' => ['required','string',Rule::exists('pessoa','pes_id')],
            'unid_id' => ['required', 'numeric', 'min:1', Rule::exists('unidade', 'unid_id')],
            'lot_data_lotacao' => ['required', 'date', 'before_or_equal:' . date('Y-m-d')],
            'lot_data_remocao' => ['nullable', 'date', 'after:lot_data_lotacao'],
            'lot_portaria' => ['required', 'string', 'min:1', 'max:20']
        ];
    }
}
