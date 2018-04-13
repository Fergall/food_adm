<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Promocion
 * 
 * @property int $idpromocion
 * @property string $promocion_nombre
 * @property string $promocion_descripcion
 * @property int $promocion_precio
 * @property int $categoria_idcategoria
 * 
 * @property \App\Models\Categorium $categorium
 * @property \Illuminate\Database\Eloquent\Collection $rel_prom_detalles
 * @property \Illuminate\Database\Eloquent\Collection $rel_prom_prods
 *
 * @package App\Models
 */
class Promocion extends Eloquent
{
	protected $table = 'promocion';
	protected $primaryKey = 'idpromocion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idpromocion' => 'int',
		'promocion_precio' => 'int',
		'categoria_idcategoria' => 'int'
	];

	protected $fillable = [
		'promocion_nombre',
		'promocion_descripcion',
		'promocion_precio',
		'categoria_idcategoria'
	];

	public function categorium()
	{
		return $this->belongsTo(\App\Models\Categorium::class, 'categoria_idcategoria');
	}

	public function rel_prom_detalles()
	{
		return $this->hasMany(\App\Models\RelPromDetalle::class, 'promocion_idpromocion');
	}

	public function rel_prom_prods()
	{
		return $this->hasMany(\App\Models\RelPromProd::class, 'promocion_idpromocion');
	}
}
