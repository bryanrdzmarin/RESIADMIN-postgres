<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBecadoRequest extends FormRequest
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
            'ci' => "required|digits:11|unique:becados,ci",
            'nombre' => [
                'required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/'
            ],
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            
        ];
    
        // Si el becado es nacional
        if ($this->nacionalidad === 'nacional') {
            $rules['direccion'] = ['required', 'string', 'min:4', 'max:255'];
          
        }
    
        // Si el becado es extranjero
        if ($this->nacionalidad === 'extranjero') {
            $rules += [
                'pasaporte' => ['required', 'digits:11', 'unique:becados_extranjeros,numero_pasaporte'],
                'pais' => ['required', 'string', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/'],
                'direccion_embajada' => ['required', 'string', 'min:4', 'max:255'],
                'year_entrada' => ['required','integer'],
            ];

        }
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
