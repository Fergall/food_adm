<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RelProdDetalle
 * 
 * @property int $idrel_prod_detalle
 * @property int $producto_idproducto
 * @property int $detalle_pedido_iddetalle_pedido
 * @property int $cant_prod_detalle
 * 
 * @property \App\Models\DetallePedido $detalle_pedido
 * @property \App\Models\Producto $producto
 *
 * @package App\Models
 */
class RelProdDetalle extends Eloquent
{
	protected $table = 'rel_prod_detalle';
	protected $primaryKey = 'idrel_prod_detalle';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idrel_prod_detalle' => 'int',
		'producto_idproducto' => 'int',
		'detalle_pedido_iddetalle_pedido' => 'int',
		'cant_prod_detalle' => 'int'
	];

	protected $fillable = [
		'producto_idproducto',
		'detalle_pedido_iddetalle_pedido',
		'cant_prod_detalle'
	];

	public function detalle_pedido()
	{
		return $this->belongsTo(\App\Models\DetallePedido::class, 'detalle_pedido_iddetalle_pedido');
	}

	public function producto()
	{
		return $this->belongsTo(\App\Models\Producto::class, 'producto_idproducto');
	}
}
