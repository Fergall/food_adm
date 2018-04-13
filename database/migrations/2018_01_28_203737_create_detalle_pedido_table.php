<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallePedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalle_pedido', function(Blueprint $table)
		{
			$table->integer('iddetalle_pedido')->primary();
			$table->integer('detalle_pedido_numero')->nullable();
			$table->date('detalle_pedido_hora_pedido')->nullable();
			$table->date('detalle_pedido_hora_entrega')->nullable();
			$table->string('detalle_pedido_nombre', 45)->nullable();
			$table->string('detalle_pedido_direccion', 45)->nullable();
			$table->integer('detalle_pedido_domicilio')->nullable();
			$table->integer('detalle_pedido_entregado')->nullable();
			$table->integer('detalle_pedido_total')->nullable();
			$table->string('detalle_pedido_fono', 15)->nullable();
			$table->string('detalle_pedido_descripcion', 45)->nullable();
			$table->integer('usuario_idusuario')->index('fk_detalle_pedido_usuario1_idx');
			$table->integer('medio_pago_idmedio_pago')->index('fk_detalle_pedido_medio_pago1_idx');
			$table->integer('detalle_pedido_pagado')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detalle_pedido');
	}

}
