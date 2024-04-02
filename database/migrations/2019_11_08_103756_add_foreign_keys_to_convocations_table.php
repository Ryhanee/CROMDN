<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConvocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('convocations', function(Blueprint $table)
		{
			$table->foreign('id_plainte', 'convocations_ibfk_3')->references('id')->on('plaintes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('convocations', function(Blueprint $table)
		{
			$table->dropForeign('convocations_ibfk_3');
		});
	}

}
