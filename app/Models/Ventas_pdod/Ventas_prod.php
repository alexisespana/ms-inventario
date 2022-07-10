<?php

namespace App\Models\Ventas_pdod;

use App\Models\Productos\Productos;
use App\Models\Ventas\Ventas;
use Illuminate\Database\Eloquent\Model;

class Ventas_prod extends Model
{
    protected $table = 'ventas_prod';
    public $timestamps = false;
    protected $fillable = ['id_venta', 'id_prod','cantidad'];

    public function ventas()
    {
        // return $this->belongsToMany(Ventas::class, 'id_venta', 'id');
    }
    public function productos()
    {
        // return $this->belongsToMany(Productos::class, 'id_prod', 'id');
    }
}
