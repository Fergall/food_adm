<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelProdDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rel_prod_detalle', function(Blueprint $table)
		{
			$table->integer('idrel_prod_detalle')->primary();
			$table->integer('producto_idproducto')->index('fk_rel_prod_detalle_producto1_idx');
			$table->integer('detalle_pedido_iddetalle_pedido')->index('fk_rel_prod_detalle_detalle_pedido1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rel_prod_detalle');
	}

}
