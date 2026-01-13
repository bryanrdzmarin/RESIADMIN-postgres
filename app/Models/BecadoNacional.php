<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecadoNacional extends Model
{
    use HasFactory;
    protected $table = 'becados_nacionales';
    protected $primaryKey = 'becados_ci';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $fillable = [
        'direccion',
        'becados_ci'
    ];
    

    public function becado()
    {
        return $this->belongsTo(Becado::class, 'becados_ci', 'ci');
    }
    
}
