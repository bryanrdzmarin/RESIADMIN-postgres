<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Becado extends Model
{
    use HasFactory;
    protected $table = 'becados';
    protected $primaryKey = 'ci'; // Especificando la clave primaria
    public $incrementing = false; // Porque 'ci' no es autoincremental
    protected $keyType = 'string'; // 'ci' es una cadena en lugar de un número

    protected $fillable = [
        'ci',
        'nombre',
        'fecha_nacimiento',
        'year_carrera',
        'carrera',
        'origen',
        'evaluacion_jefe_residencia',
        'evaluacion_jefe_apto',
        'evaluacion_profesor',
        'evaluacion_final',
        'aptos_id',
        'residencias_id',
    ];

    //Mutadores y Accesores
    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value), 
            set: fn ($value) => strtolower($value) 
        );
    }

    protected function yearCarrera(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function carrera(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function origen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    /*protected function evaluacionJefeResidencia(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? 'No evaluado' : $value,
            set: fn ($value) => ($value === 'No evaluado' || $value === '' || $value === null) ? null : $value
        );
    }

    protected function evaluacionJefeApto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? 'No evaluado' : $value,
            set: fn ($value) => ($value === 'No evaluado' || $value === '' || $value === null) ? null : $value
        );
    }

    protected function evaluacionProfesor(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? 'No evaluado' : $value,
            set: fn ($value) => ($value === 'No evaluado' || $value === '' || $value === null) ? null : $value
        );
    }*/

    //Realaciones
    public function apto()
    {
        return $this->belongsTo(Apto::class, 'aptos_id');
    }

    // Relación con Residencia
    public function residencia()
    {
        return $this->belongsTo(Residencia::class, 'residencias_id');
    }

    // Relación con BecadoNacional (uno a uno)
    public function becadoNacional()
    {
        return $this->hasOne(BecadoNacional::class, 'becados_ci', 'ci');
    }

    // Relación con BecadoExtranjero (uno a uno)
    public function becadoExtranjero()
    {
        return $this->hasOne(BecadoExtranjero::class, 'becados_ci', 'ci');
    }

    //Metodos para calcular evaluacion final 
    public function evaluarNacionales()
    {

        // Calculamos el promedio con collect() para mayor eficiencia
        $promedio = collect([
            $this->evaluacion_jefe_residencia, 
            $this->evaluacion_jefe_apto, 
            $this->evaluacion_profesor
        ])->avg();


        // Primero revisamos si alguna evaluación es 2 y asignamos "Mal"
        if (in_array(2, [$this->evaluacion_jefe_residencia, $this->evaluacion_jefe_apto, $this->evaluacion_profesor])) {
            $this->evaluacion_final = 'Mal';
        }
        
        else if (is_null($this->evaluacion_jefe_residencia) || 
            is_null($this->evaluacion_jefe_apto) || 
            is_null($this->evaluacion_profesor)) {
            return null;
        }
        else{
            $this->evaluacion_final = match(true) {
                $promedio >= 3 && $promedio < 4   => 'Regular',
                $promedio >= 4 && $promedio <= 4.75 => 'Bien',
                $promedio > 4.75                   => 'Excelente',
                default                             => null, // Si ninguna condición se cumple
            };
            
        }

        $this->save();
    }

    
    public function evaluarExtranjeros()
    {
        $becadoExtranjero = $this->becadoExtranjero;

        if (!$becadoExtranjero) {
            return null; 
        }

        $jefeResidencia = $this->evaluacion_jefe_residencia;
        $jefeApto = $this->evaluacion_jefe_apto;
        $profesor = $this->evaluacion_profesor;
        $jefeRelaciones = $becadoExtranjero->evaluacion_jefe_relaciones_internacionales;

        $promedio = collect([$jefeResidencia, $jefeApto, $profesor, $jefeRelaciones])->avg();

        if (in_array(2, [$jefeResidencia, $jefeApto, $profesor, $jefeRelaciones])) {
            $this->evaluacion_final = 'Mal';
        } else {
            $this->evaluacion_final = match (true) {
                $promedio >= 3 && $promedio < 4   => 'Regular',
                $promedio >= 4 && $promedio <= 4.75 => 'Bien',
                $promedio > 4.75                   => 'Excelente',
                default                             => null, 
            };
        }
        $this->save();
    }

}

