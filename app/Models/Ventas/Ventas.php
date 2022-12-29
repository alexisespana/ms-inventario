<?php

namespace App\Models\Ventas;

use App\Models\Productos\Productos;
use App\Models\Ventas_pdod\Ventas_prod;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['medio_pago','suma_prod','cant_prods','procesada','valor_compra','pagado','cambio','fecha','cod_operacion'];


    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'ventas_prod','id_venta', 'id_prod',);

    }
    public function ventas_prod()
    {
        return $this->hasMany(Ventas_prod::class,'id_venta','id');
    }
}
