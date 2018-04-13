<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RelPromProd
 * 
 * @property int $idrel_prom_prod
 * @property int $rel_prom_prod_cantidad
 * @property int $promocion_idpromocion
 * @property int $producto_idproducto
 * 
 * @property \App\Models\Producto $producto
 * @property \App\Models\Promocion $promocion
 *
 * @package App\Models
 */
class RelPromProd extends Eloquent
{
	protected $table = 'rel_prom_prod';
	protected $primaryKey = 'idrel_prom_prod';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idrel_prom_prod' => 'int',
		'rel_prom_prod_cantidad' => 'int',
		'promocion_idpromocion' => 'int',
		'producto_idproducto' => 'int'
	];

	protected $fillable = [
		'rel_prom_prod_cantidad',
		'promocion_idpromocion',
		'producto_idproducto'
	];

	public function producto()
	{
		return $this->belongsTo(\App\Models\Producto::class, 'producto_idproducto');
	}

	public function promocion()
	{
		return $this->belongsTo(\App\Models\Promocion::class, 'promocion_idpromocion');
	}
}
