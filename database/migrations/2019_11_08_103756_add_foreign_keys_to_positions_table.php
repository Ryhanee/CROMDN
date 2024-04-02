<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('positions', function(Blueprint $table)
		{
			$table->foreign('id_medecin', 'positions_ibfk_1')->references('id')->on('medecins')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('positions', function(Blueprint $table)
		{
			$table->dropForeign('positions_ibfk_1');
		});
	}

}
