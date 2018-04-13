<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RelPromDetalle
 * 
 * @property int $idrel_prom_detalle
 * @property int $promocion_idpromocion
 * @property int $detalle_pedido_iddetalle_pedido
 * @property int $cant_prom_detalle
 * 
 * @property \App\Models\DetallePedido $detalle_pedido
 * @property \App\Models\Promocion $promocion
 *
 * @package App\Models
 */
class RelPromDetalle extends Eloquent
{
	protected $table = 'rel_prom_detalle';
	protected $primaryKey = 'idrel_prom_detalle';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idrel_prom_detalle' => 'int',
		'promocion_idpromocion' => 'int',
		'detalle_pedido_iddetalle_pedido' => 'int',
		'cant_prom_detalle' => 'int'
	];

	protected $fillable = [
		'promocion_idpromocion',
		'detalle_pedido_iddetalle_pedido',
		'cant_prom_detalle'
	];

	public function detalle_pedido()
	{
		return $this->belongsTo(\App\Models\DetallePedido::class, 'detalle_pedido_iddetalle_pedido');
	}

	public function promocion()
	{
		return $this->belongsTo(\App\Models\Promocion::class, 'promocion_idpromocion');
	}
}
