<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEtatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('etats', function(Blueprint $table)
		{
			$table->foreign('id_type', 'etats_ibfk_1')->references('id')->on('type_etats')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_medecin', 'etats_ibfk_2')->references('id')->on('medecins')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('etats', function(Blueprint $table)
		{
			$table->dropForeign('etats_ibfk_1');
			$table->dropForeign('etats_ibfk_2');
		});
	}

}
