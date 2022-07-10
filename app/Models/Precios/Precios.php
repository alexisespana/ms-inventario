<?php

namespace App\Models\Precios;

use App\Models\Productos\Productos;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    protected $table = 'precios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_prod','precio','precio_promo', 'fecha_inicio', 'fecha_fin','vigente'];

    public function productos()
    {
        return $this->hasOne(Productos::class,'id','id');

    }


}
