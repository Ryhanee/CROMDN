<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCotisationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cotisations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('id_medecin')->unsigned()->nullable()->index('id_user');
			$table->integer('annee')->nullable()->index('annee');
			$table->integer('montant')->nullable()->comment('=0:impayée; <>0 :payée');
			$table->integer('payment')->default(0);
			$table->integer('radie')->nullable()->default(0);
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
		Schema::drop('cotisations');
	}

}
