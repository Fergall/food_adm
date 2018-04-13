<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto', function(Blueprint $table)
		{
			$table->integer('idproducto')->primary();
			$table->string('producto_nombre', 45)->nullable();
			$table->integer('producto_precio')->nullable();
			$table->string('producto_descripcion', 45)->nullable();
			$table->integer('categoria_idcategoria')->index('fk_producto_categoria_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('producto');
	}

}
