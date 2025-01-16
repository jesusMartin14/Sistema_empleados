<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';

    protected $primaryKey = 'idnivel';
    protected $fillable = ['salario'];
    public $timestamps = false;
}
