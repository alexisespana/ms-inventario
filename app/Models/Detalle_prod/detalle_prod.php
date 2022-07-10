<?php

namespace App\Models\Detalle_prod;

use App\Models\Marca_prod\marca_prod;
use Illuminate\Database\Eloquent\Model;

class detalle_prod extends Model
{
    protected $table = 'detalle_prod';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_marca', 'descripcion'];


    public function productos()
    {
        return $this->hasMany(marca_prod::class, 'id_marca', 'id');
    }
}
