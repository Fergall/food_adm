<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRelProdIngTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rel_prod_ing', function(Blueprint $table)
		{
			$table->foreign('ingrediente_idingrediente', 'fk_rel_prod_ing_ingrediente1')->references('idingrediente')->on('ingrediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('producto_idproducto', 'fk_rel_prod_ing_producto1')->references('idproducto')->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rel_prod_ing', function(Blueprint $table)
		{
			$table->dropForeign('fk_rel_prod_ing_ingrediente1');
			$table->dropForeign('fk_rel_prod_ing_producto1');
		});
	}

}
