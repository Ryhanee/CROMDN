<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedecinAttestationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medecin_attestations', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->bigInteger('id_medecin')->unsigned()->index('id_user');
			$table->boolean('id_attestation')->index('id_attestation');
			$table->date('date_attestation');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medecin_attestations');
	}

}
