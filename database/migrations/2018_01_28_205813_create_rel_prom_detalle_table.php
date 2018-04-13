<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelPromDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rel_prom_detalle', function(Blueprint $table)
		{
			$table->integer('idrel_prom_prod')->primary();
			$table->integer('promocion_idpromocion')->index('fk_rel_prom_detalle_promocion1_idx');
			$table->integer('detalle_pedido_iddetalle_pedido')->index('fk_rel_prom_detalle_detalle_pedido1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rel_prom_detalle');
	}

}
