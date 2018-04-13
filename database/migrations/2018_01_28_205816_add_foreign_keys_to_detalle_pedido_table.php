<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetallePedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detalle_pedido', function(Blueprint $table)
		{
			$table->foreign('medio_pago_idmedio_pago', 'fk_detalle_pedido_medio_pago1')->references('idmedio_pago')->on('medio_pago')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_idusuario', 'fk_detalle_pedido_usuario1')->references('idusuario')->on('usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detalle_pedido', function(Blueprint $table)
		{
			$table->dropForeign('fk_detalle_pedido_medio_pago1');
			$table->dropForeign('fk_detalle_pedido_usuario1');
		});
	}

}
