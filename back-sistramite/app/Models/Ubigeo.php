<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'tipo',
        'cod_dep',
        'cod_prov',
        'cod_dist',
        'nombre',
    ];

    protected $primaryKey = 'codigo';
}
