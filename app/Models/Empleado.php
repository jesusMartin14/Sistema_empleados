<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'idempleado';
    protected $fillable = ['nombre','primer_apellido','segundo_apellido','email','idcargo','idnivel','fecha_contratacion'];

    public function salarioEmpleado(){
        return $this->hasOne(Nivel::class,'idnivel','idnivel');
    }

    public function cargoEmpleado(){
        return $this->hasOne(Cargo::class,'idcargo','idcargo');
    }
}
