<?php

namespace App\Models\PrecioCompra;

use App\Models\Stock\Stock;
use Illuminate\Database\Eloquent\Model;

class PrecioCompra extends Model
{
    protected $table = 'precio_compra';
    public $timestamps = false;
    protected $fillable = ['id_stock', 'precio','fecha'];

    public function stock()
    {
         return $this->belongsToMany(Stock::class, 'id_stock', 'id');
    }
   
}
