<?php

namespace App\Models\Productos;

use App\Models\Categoria\Categoria;
use App\Models\Marca_prod\marca_prod;
use App\Models\Precios\Precios;
use App\Models\Stock\Stock;
use App\Models\UnidadMedida\UnidadMedida;
use App\Models\Ventas\Ventas;
use App\Models\Ventas_pdod\Ventas_prod;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['codigo','nombre', 'categoria', 'unidad_medida','imagen'];


    public function stock()
    {
        return $this->hasOne(Stock::class,'id_prod','id');

    }

    public function precio()
    {
        return $this->hasOne(Precios::class,'id_prod','id');

    }
    public function categoria()
    {
        return $this->hasOne(Categoria::class,'id','categoria');

    }
    public function unidad_medida()
    {
        return $this->hasOne(UnidadMedida::class,'id','unidad_medida');

    }
    // public function ventas_prod()
    // {
    //     return $this->belongsToMany(Ventas::class, Ventas_prod::class)->withPivot('id_venta');
    // }

}
