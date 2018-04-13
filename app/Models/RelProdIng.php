<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RelProdIng
 * 
 * @property int $idrel_prod_ing
 * @property int $producto_idproducto
 * @property int $ingrediente_idingrediente
 * 
 * @property \App\Models\Ingrediente $ingrediente
 * @property \App\Models\Producto $producto
 *
 * @package App\Models
 */
class RelProdIng extends Eloquent
{
	protected $table = 'rel_prod_ing';
	protected $primaryKey = 'idrel_prod_ing';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idrel_prod_ing' => 'int',
		'producto_idproducto' => 'int',
		'ingrediente_idingrediente' => 'int'
	];

	protected $fillable = [
		'producto_idproducto',
		'ingrediente_idingrediente'
	];

	public function ingrediente()
	{
		return $this->belongsTo(\App\Models\Ingrediente::class, 'ingrediente_idingrediente');
	}

	public function producto()
	{
		return $this->belongsTo(\App\Models\Producto::class, 'producto_idproducto');
	}
}
