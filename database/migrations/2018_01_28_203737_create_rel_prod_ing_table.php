<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelProdIngTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rel_prod_ing', function(Blueprint $table)
		{
			$table->integer('idrel_prod_ing')->primary();
			$table->integer('producto_idproducto')->index('fk_rel_prod_ing_producto1_idx');
			$table->integer('ingrediente_idingrediente')->index('fk_rel_prod_ing_ingrediente1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rel_prod_ing');
	}

}
