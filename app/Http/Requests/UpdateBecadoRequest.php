<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBecadoRequest extends FormRequest
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
        $rules = [
            'nombre' => [
                'required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/'
            ], 
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d|before:today', 
            'direccion' => [
                'required_if:nacionalidad,nacional', 'string', 'min:4', 'max:255'
            ], 
            'pais' => [
               'required_if:nacionalidad,extranjero','string', 'min:4', 'max:255', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/'
            ], 
            'direccion_embajada' => ['required_if:nacionalidad,extranjero', 'string', 'min:4', 'max:255' ],
            'year_entrada' => ['required_if:nacionalidad,extranjero','integer'], 
        ];
        if ($this->evaluacion === 'Si' && $this->nacionalidad === 'nacional') {
                $rules += [
                    'evaluacion_jefe_residencia' => 'required|integer|between:2,5',
                    'evaluacion_jefe_apto' => 'required|integer|between:2,5',
                    'evaluacion_profesor' => 'required|integer|between:2,5',
                ];
            }

        if ($this->evaluacion === 'Si' && $this->nacionalidad === 'extranjero') {
                $rules += [
                    'evaluacion_jefe_residencia' => 'required|integer|between:2,5',
                    'evaluacion_jefe_apto' => 'required|integer|between:2,5',
                    'evaluacion_profesor' => 'required|integer|between:2,5',
                    'evaluacion_jefe_relaciones_internacionales' => 'required|integer|between:2,5',
                ];
            }
    
        return $rules;
    }
}
