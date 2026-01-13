<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecadoExtranjero extends Model
{
    use HasFactory;
    protected $table='becados_extranjeros';
    protected $primaryKey = 'numero_pasaporte';
    protected $fillable = [
        'becados_ci',
        'numero_pasaporte',
        'pais',
        'direccion_embajada',
        'year_entrada',
        'evaluacion_jefe_relaciones_internacionales'
    ];
    public function becado()
    {
        return $this->belongsTo(Becado::class, 'becados_ci', 'ci');
    }

    /*protected function evaluacionJefeRelacionesInternacionales(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? 'No evaluado' : $value,
            set: fn ($value) => ($value === 'No evaluado' || $value === '' || $value === null) ? null : $value
        );
    }*/

}
