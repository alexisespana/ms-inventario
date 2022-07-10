<?php

namespace App\Models\Categoria;

use App\Models\Productos\Productos;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre'];


    public function productos()
    {
        return $this->hasMany(Productos::class, 'id', 'id');
    }
}
