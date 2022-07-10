<?php

namespace App\Models\Stock;

use App\Models\PrecioCompra\PrecioCompra;
use App\Models\Productos\Productos;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_prod', 'cantidad', 'fecha_ingreso','fecha_venc'];


    public function productos() {
        return $this->hasOne(Productos::class,'id','id_prod');
    }

    public function precio_compra() {
        return $this->hasOne(PrecioCompra::class,'id_stock','id');
    }
}
