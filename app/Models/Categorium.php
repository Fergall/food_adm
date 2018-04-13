<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Categorium
 * 
 * @property int $idcategoria
 * @property string $categoria_nombre
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos
 * @property \Illuminate\Database\Eloquent\Collection $promocions
 *
 * @package App\Models
 */
class Categorium extends Eloquent
{
	protected $primaryKey = 'idcategoria';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idcategoria' => 'int'
	];

	protected $fillable = [
		'categoria_nombre'
	];

	public function productos()
	{
		return $this->hasMany(\App\Models\Producto::class, 'categoria_idcategoria');
	}

	public function promocions()
	{
		return $this->hasMany(\App\Models\Promocion::class, 'categoria_idcategoria');
	}
}
