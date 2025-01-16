<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $primaryKey = 'idcargo';
    protected $fillable = ['nombre_cargo'];
    public $timestamps = false;

}
