<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Mar 2018 16:41:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ingrediente
 * 
 * @property int $idingrediente
 * @property string $ingrediente_nombre
 * @property string $ingrediente_descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $rel_prod_ings
 *
 * @package App\Models
 */
class Ingrediente extends Eloquent
{
	protected $table = 'ingrediente';
	protected $primaryKey = 'idingrediente';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idingrediente' => 'int'
	];

	protected $fillable = [
		'ingrediente_nombre',
		'ingrediente_descripcion'
	];

	public function rel_prod_ings()
	{
		return $this->hasMany(\App\Models\RelProdIng::class, 'ingrediente_idingrediente');
	}
}
