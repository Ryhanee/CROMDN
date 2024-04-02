<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDisciplinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('disciplines', function(Blueprint $table)
		{
			$table->foreign('id_medecin', 'disciplines_ibfk_1')->references('id')->on('medecins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_sanction', 'disciplines_ibfk_2')->references('id')->on('type_sanctions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('disciplines', function(Blueprint $table)
		{
			$table->dropForeign('disciplines_ibfk_1');
			$table->dropForeign('disciplines_ibfk_2');
		});
	}

}
