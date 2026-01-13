<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    use HasFactory;
    protected $table='residencias';
    protected $fillable = ['nombre', 'cantidad_aptos', 'jefe_consejo_residencia', 'profesor_asignado', 'evaluacion'];
    

    // Relación con Aptos
    public function aptos()
    {
        return $this->hasMany(Apto::class, 'residencias_id');
    }

    // Relación indirecta con Becados a través de Aptos
    public function becados()
    {
        return $this->hasManyThrough(Becado::class, Apto::class);
    }

    
   // Mutador y Accesor para el nombre
   public function nombre(): Attribute
   {
       return Attribute::make(
           set: fn($value) => strtolower($value),
           get: fn($value) => ucfirst($value)
       );
   }

   // Mutador y Accesor para cantidad de apartamentos
   public function cantidadAptos(): Attribute
   {
       return Attribute::make(
           set: fn($value) => (int) $value,
           get: fn($value) => $value
       );
   }

   // Mutador y Accesor para jefe del consejo de residencia
   public function jefeConsejoResidencia(): Attribute
   {
       return Attribute::make(
           set: fn($value) => ucwords(strtolower($value)),
           get: fn($value) => ucwords($value)
       );
   }

   // Mutador y Accesor para profesor asignado
   public function profesorAsignado(): Attribute
   {
       return Attribute::make(
           set: fn($value) => ucwords(strtolower($value)),
           get: fn($value) => ucwords($value)
       );
   }

   // Mutador y Accesor para evaluación, mostrando "Sin evaluación" si está vacía
    public function evaluacion(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ?: 'Sin evaluación'
        );
    }

    public function evaluarResidencia()
    {
        $aptos = $this->aptos(); 
        $cantidadAptos = $aptos->count();

        // Si no hay aptos, la evaluación es null
        if ($cantidadAptos === 0) {
            $this->evaluacion = null;
            $this->save();
            return;
        }

        $mal = 0;
        $regular = 0;
        $bien = 0;
        $excelente = 0;

        foreach ($aptos as $apto) {
            switch ($apto->evaluacion) {
                case 'mal': $mal++; break;
                case 'regular': $regular++; break;
                case 'bien': $bien++; break;
                case 'excelente': $excelente++; break;
            }
        }

        // Cálculo de porcentajes
        $porcentajeMal = ($mal * 100) / $cantidadAptos;
        $porcentajeRegular = ($regular * 100) / $cantidadAptos;
        $porcentajeBien = ($bien * 100) / $cantidadAptos;
        $porcentajeExcelente = ($excelente * 100) / $cantidadAptos;

        // Asignación de evaluación sin usar return
        if ($porcentajeMal >= 5) {
            $this->evaluacion = 'Mal';
        } elseif ($porcentajeRegular >= 30) {
            $this->evaluacion = 'Regular';
        } elseif ($porcentajeBien <= 30) {
            $this->evaluacion = 'Bien';
        } elseif ($porcentajeExcelente === 100) {
            $this->evaluacion = 'Excelente';
        } else {
            $this->evaluacion = 'Evaluación indeterminada';
        }

        // Guardar la evaluación en la tabla residencia
        $this->save();
    }

   
}

