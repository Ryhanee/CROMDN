<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModeTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mode_types', function(Blueprint $table)
		{
			$table->integer('id_type_etat')->index('id_type_etat');
			$table->integer('id_mode_exercice')->index('id_mode_exercice');
			$table->primary(['id_type_etat','id_mode_exercice']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mode_types');
	}

}
