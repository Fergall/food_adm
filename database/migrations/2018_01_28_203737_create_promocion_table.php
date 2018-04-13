<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromocionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promocion', function(Blueprint $table)
		{
			$table->integer('idpromocion')->primary();
			$table->string('promocion_nombre', 45)->nullable();
			$table->string('promocion_descripcion', 45)->nullable();
			$table->integer('promocion_precio')->nullable();
			$table->integer('categoria_idcategoria')->index('fk_promocion_categoria1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promocion');
	}

}
