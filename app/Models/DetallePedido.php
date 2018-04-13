<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DetallePedido
 * 
 * @property int $iddetalle_pedido
 * @property int $detalle_pedido_numero
 * @property \Carbon\Carbon $detalle_pedido_hora_pedido
 * @property \Carbon\Carbon $detalle_pedido_hora_entrega
 * @property string $detalle_pedido_nombre
 * @property string $detalle_pedido_direccion
 * @property int $detalle_pedido_domicilio
 * @property int $detalle_pedido_entregado
 * @property int $detalle_pedido_total
 * @property string $detalle_pedido_fono
 * @property string $detalle_pedido_descripcion
 * @property int $usuario_idusuario
 * @property int $medio_pago_idmedio_pago
 * @property int $detalle_pedido_pagado
 * 
 * @property \App\Models\MedioPago $medio_pago
 * @property \App\Models\Usuario $usuario
 * @property \Illuminate\Database\Eloquent\Collection $rel_prod_detalles
 * @property \Illuminate\Database\Eloquent\Collection $rel_prom_detalles
 *
 * @package App\Models
 */
class DetallePedido extends Eloquent
{
	protected $table = 'detalle_pedido';
	protected $primaryKey = 'iddetalle_pedido';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'iddetalle_pedido' => 'int',
		'detalle_pedido_numero' => 'int',
		'detalle_pedido_domicilio' => 'int',
		'detalle_pedido_entregado' => 'int',
		'detalle_pedido_total' => 'int',
		'usuario_idusuario' => 'int',
		'medio_pago_idmedio_pago' => 'int',
		'detalle_pedido_pagado' => 'int'
	];

	protected $dates = [
		'detalle_pedido_hora_pedido',
		'detalle_pedido_hora_entrega'
	];

	protected $fillable = [
		'detalle_pedido_numero',
		'detalle_pedido_hora_pedido',
		'detalle_pedido_hora_entrega',
		'detalle_pedido_nombre',
		'detalle_pedido_direccion',
		'detalle_pedido_domicilio',
		'detalle_pedido_entregado',
		'detalle_pedido_total',
		'detalle_pedido_fono',
		'detalle_pedido_descripcion',
		'usuario_idusuario',
		'medio_pago_idmedio_pago',
		'detalle_pedido_pagado'
	];

	public function medio_pago()
	{
		return $this->belongsTo(\App\Models\MedioPago::class, 'medio_pago_idmedio_pago');
	}

	public function usuario()
	{
		return $this->belongsTo(\App\Models\Usuario::class, 'usuario_idusuario');
	}

	public function rel_prod_detalles()
	{
		return $this->hasMany(\App\Models\RelProdDetalle::class, 'detalle_pedido_iddetalle_pedido');
	}

	public function rel_prom_detalles()
	{
		return $this->hasMany(\App\Models\RelPromDetalle::class, 'detalle_pedido_iddetalle_pedido');
	}
}
