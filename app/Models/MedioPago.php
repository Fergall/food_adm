<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MedioPago
 * 
 * @property int $idmedio_pago
 * @property string $medio_pago_nombre
 * 
 * @property \Illuminate\Database\Eloquent\Collection $detalle_pedidos
 *
 * @package App\Models
 */
class MedioPago extends Eloquent
{
	protected $table = 'medio_pago';
	protected $primaryKey = 'idmedio_pago';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idmedio_pago' => 'int'
	];

	protected $fillable = [
		'medio_pago_nombre'
	];

	public function detalle_pedidos()
	{
		return $this->hasMany(\App\Models\DetallePedido::class, 'medio_pago_idmedio_pago');
	}
}
