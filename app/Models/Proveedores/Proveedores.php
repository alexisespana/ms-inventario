<?php

namespace App\Models\Proveedores;

use App\Models\Categoria\Categoria;
use App\Models\Precios_prov\Precios_prov;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['codigo','nombre', 'categoria', 'unidad_medida','imagen'];

    public function categoria()
    {
        return $this->hasOne(Categoria::class,'id_prod','id');

    }

    public function precios_prov()
    {
        return $this->belongsToMany(Precios_prov::class,'id_prod','id');

    }
}
