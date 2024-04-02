<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNumerolasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('numerolas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('id_attestation')->nullable()->index('idAttestation');
			$table->boolean('id_lettre')->nullable()->index('idLettre');
			$table->bigInteger('id_medecin')->unsigned()->index('idMedecin');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('numerolas');
	}

}
