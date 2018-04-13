<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRelPromProdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rel_prom_prod', function(Blueprint $table)
		{
			$table->foreign('producto_idproducto', 'fk_rel_prom_prod_producto1')->references('idproducto')->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('promocion_idpromocion', 'fk_rel_prom_prod_promocion1')->references('idpromocion')->on('promocion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rel_prom_prod', function(Blueprint $table)
		{
			$table->dropForeign('fk_rel_prom_prod_producto1');
			$table->dropForeign('fk_rel_prom_prod_promocion1');
		});
	}

}
