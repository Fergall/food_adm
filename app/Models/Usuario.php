<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Usuario
 * 
 * @property int $idusuario
 * @property string $usuario_nombre
 * @property string $usuario_user
 * @property string $usuario_pass
 * 
 * @property \Illuminate\Database\Eloquent\Collection $detalle_pedidos
 *
 * @package App\Models
 */
class Usuario extends Eloquent
{
	protected $table = 'usuario';
	protected $primaryKey = 'idusuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int'
	];

	protected $fillable = [
		'usuario_nombre',
		'usuario_user',
		'usuario_pass'
	];

	public function detalle_pedidos()
	{
		return $this->hasMany(\App\Models\DetallePedido::class, 'usuario_idusuario');
	}
}
