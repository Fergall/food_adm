<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Producto
 * 
 * @property int $idproducto
 * @property string $producto_nombre
 * @property int $producto_precio
 * @property string $producto_descripcion
 * @property int $categoria_idcategoria
 * 
 * @property \App\Models\Categorium $categorium
 * @property \Illuminate\Database\Eloquent\Collection $rel_prod_detalles
 * @property \Illuminate\Database\Eloquent\Collection $rel_prod_ings
 * @property \Illuminate\Database\Eloquent\Collection $rel_prom_prods
 *
 * @package App\Models
 */
class Producto extends Eloquent
{
	protected $table = 'producto';
	protected $primaryKey = 'idproducto';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idproducto' => 'int',
		'producto_precio' => 'int',
		'categoria_idcategoria' => 'int'
	];

	protected $fillable = [
		'producto_nombre',
		'producto_precio',
		'producto_descripcion',
		'categoria_idcategoria'
	];

	public function categorium()
	{
		return $this->belongsTo(\App\Models\Categorium::class, 'categoria_idcategoria');
	}

	public function rel_prod_detalles()
	{
		return $this->hasMany(\App\Models\RelProdDetalle::class, 'producto_idproducto');
	}

	public function rel_prod_ings()
	{
		return $this->hasMany(\App\Models\RelProdIng::class, 'producto_idproducto');
	}

	public function rel_prom_prods()
	{
		return $this->hasMany(\App\Models\RelPromProd::class, 'producto_idproducto');
	}
}
