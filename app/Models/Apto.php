<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Apto extends Model
{
    protected $table = 'aptos';
    protected $primaryKey = 'id'; 
    use HasFactory;
    
    protected $fillable = [
        'residencias_id',
        'numero',
        'capacidad',
        'jefe_apartamento',
        'profesor_asignado',
        'evaluacion',
    ];

    // Relación con Residencia
    public function residencia()
    {
        return $this->belongsTo(Residencia::class,'residencias_id');
    }

    // Relación con Becados
    public function becados()
    {
        return $this->hasMany(Becado::class, 'aptos_id');
    }


    
     public function CantidadBecados()
    {
        return (int) $this->becados()->count();
    }

    //Evaluar
    public function Evaluar()
    {
        $becados = $this->becados;
        $cantidadBecados = $becados->count();

        // Si no hay becados, la evaluación es null
        if ($cantidadBecados === 0) {
            $this->evaluacion = null;
            $this->save();
            return;
        }

        $mal = 0;
        $regular = 0;
        $bien = 0;
        $excelente = 0;

        foreach ($becados as $becado) {
            // Si algún estudiante tiene evaluación null, la evaluación del apto es null
            if (is_null($becado->evaluacion_final)) {
                $this->evaluacion = null;
                $this->save();
                return;
            }

            // Convertir la evaluación a minúsculas para evitar problemas de comparación
            $evaluacion = strtolower($becado->evaluacion_final);

            switch ($evaluacion) {
                case 'mal': $mal++; break;
                case 'regular': $regular++; break;
                case 'bien': $bien++; break;
                case 'excelente': $excelente++; break;
            }
        }

        // Evaluación "Excelente"
        if ($excelente === $cantidadBecados) {
            $this->evaluacion = 'excelente';
        } elseif ($mal > 0) {
            $this->evaluacion = 'mal';
        } else {
            $porcentajeRegular = ($regular * 100) / $cantidadBecados;
            if ($porcentajeRegular >= 30) {
                $this->evaluacion = 'regular';
            } else {
                $this->evaluacion = 'bien';
            }
        }

        $this->save();
    }



    //Mutadores y accesores
      protected function jefeApartamento(): Attribute 
      {
            return Attribute::make(
                set: fn($value) => mb_strtolower($value), 
                get: fn($value) => ucfirst(mb_strtolower($value))
            );
      }
  
      protected function profesorAsignado(): Attribute 
      {
            return Attribute::make(
                set: fn($value) => mb_strtolower($value),
                get: fn($value) => ucfirst(mb_strtolower($value))
            );
      }
  
      protected function evaluacion(): Attribute
      {
            return Attribute::make(
                set: fn($value) => $value ? mb_strtolower($value) : null,
                get: fn($value) => $value ? ucfirst(mb_strtolower($value)) : null
            );
      }


   
    
}
