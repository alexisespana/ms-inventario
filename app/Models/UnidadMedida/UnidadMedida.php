<?php

namespace App\Models\UnidadMedida;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidad_medida';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'simbolo'];


    public function productos()
    {
        return $this->hasOne(Productos::class, 'id', 'unidad_medida');
    }
}
