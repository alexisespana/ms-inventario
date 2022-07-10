<?php

namespace App\Models\Precios_prov;

use App\Models\Productos\Productos;
use App\Models\Proveedores\Proveedores;
use Illuminate\Database\Eloquent\Model;

class Precios_prov extends Model
{
    protected $table = 'precios_prov';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['codigo','nombre', 'categoria', 'unidad_medida','imagen'];

    public function productos()
    {
        return $this->hasMany(Productos::class,'id_prod','id');

    }

    public function proveedores()
    {
        return $this->hasMany(Proveedores::class,'id_prod','id');

    }
}
