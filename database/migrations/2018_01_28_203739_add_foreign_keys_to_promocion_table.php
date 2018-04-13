<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPromocionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promocion', function(Blueprint $table)
		{
			$table->foreign('categoria_idcategoria', 'fk_promocion_categoria1')->references('idcategoria')->on('categoria')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promocion', function(Blueprint $table)
		{
			$table->dropForeign('fk_promocion_categoria1');
		});
	}

}
