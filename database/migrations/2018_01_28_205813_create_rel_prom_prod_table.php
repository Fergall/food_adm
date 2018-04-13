<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelPromProdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rel_prom_prod', function(Blueprint $table)
		{
			$table->integer('idrel_prom_prod')->primary();
			$table->integer('rel_prom_prod_cantidad')->nullable();
			$table->integer('promocion_idpromocion')->index('fk_rel_prom_prod_promocion1_idx');
			$table->integer('producto_idproducto')->index('fk_rel_prom_prod_producto1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rel_prom_prod');
	}

}
