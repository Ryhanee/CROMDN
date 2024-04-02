<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeModeExercicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('type_mode_exercices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_mode')->index('id-mode');
			$table->string('libelle', 55);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('type_mode_exercices');
	}

}
