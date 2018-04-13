<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIngredienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingrediente', function(Blueprint $table)
		{
			$table->integer('idingrediente')->primary();
			$table->string('ingrediente_nombre', 45)->nullable();
			$table->string('ingrediente_descripcion', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ingrediente');
	}

}
