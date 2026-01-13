<?php

namespace App\Http\Requests;

use App\Models\Apto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateAptoRequest extends FormRequest
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
           'numero' => [
                'required',
                Rule::unique('aptos')->where(function ($query) {
                    return $query->where('residencias_id', $this->input('residencias_id'));
                })->ignore($this->route('apto'))
            ],
            'residencias_id'=>'required',
           'capacidad' => 'required',
            'jefe_apartamento'=>['required','min:3','max:100'],
            'profesor_asignado'=>['required','min:3','max:100'],
        ];
    }
}
