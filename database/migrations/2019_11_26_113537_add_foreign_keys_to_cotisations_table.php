<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCotisationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cotisations', function(Blueprint $table)
		{
			$table->foreign('id_medecin', 'cotisations_ibfk_1')->references('id')->on('medecins')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('annee', 'cotisations_ibfk_2')->references('annee')->on('tarifs')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cotisations', function(Blueprint $table)
		{
			$table->dropForeign('cotisations_ibfk_1');
			$table->dropForeign('cotisations_ibfk_2');
		});
	}

}
