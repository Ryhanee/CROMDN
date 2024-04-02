<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedecinLettresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medecin_lettres', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->bigInteger('id_medecin')->unsigned()->index('id_user');
			$table->boolean('id_lettre')->index('id_lettre');
			$table->date('date_lettre');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medecin_lettres');
	}

}
