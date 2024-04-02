<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaintesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plaintes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('id_medecin')->unsigned()->index('id_user');
			$table->date('date_plainte');
			$table->integer('id_motif')->index('id_motif');
			$table->string('nom_plaignant', 55)->nullable();
			$table->string('prenom_plaignant', 55)->nullable();
			$table->integer('tel_plaignant')->nullable();
			$table->integer('id_medecin_plaignant')->nullable();
			$table->text('commentaire', 65535)->nullable();
			$table->string('decision')->nullable();
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
		Schema::drop('plaintes');
	}

}
