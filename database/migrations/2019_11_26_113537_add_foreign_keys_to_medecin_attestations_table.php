<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedecinAttestationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medecin_attestations', function(Blueprint $table)
		{
			$table->foreign('id_medecin', 'medecin_attestations_ibfk_1')->references('id')->on('medecins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_attestation', 'medecin_attestations_ibfk_2')->references('id')->on('attestations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medecin_attestations', function(Blueprint $table)
		{
			$table->dropForeign('medecin_attestations_ibfk_1');
			$table->dropForeign('medecin_attestations_ibfk_2');
		});
	}

}
