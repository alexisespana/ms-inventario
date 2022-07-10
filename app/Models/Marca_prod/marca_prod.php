<?php

namespace App\Models\Marca_prod;

use App\Models\Detalle_prod\detalle_prod;
use App\Models\Productos\Productos;
use Illuminate\Database\Eloquent\Model;

class marca_prod extends Model
{
    protected $table = 'marca_prod';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'descripcion'];


    public function productos() {
        return $this->belongsTo(Productos::class,'id','id');
    }

    public function detalles()
    {
        return $this->hasMany(detalle_prod::class,'id_marca','id');
    }
}
