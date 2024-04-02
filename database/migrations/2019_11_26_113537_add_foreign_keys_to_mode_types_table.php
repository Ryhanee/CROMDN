<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModeTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mode_types', function(Blueprint $table)
		{
			$table->foreign('id_mode_exercice', 'mode_types_ibfk_1')->references('id')->on('modes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_type_etat', 'mode_types_ibfk_2')->references('id')->on('type_etats')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mode_types', function(Blueprint $table)
		{
			$table->dropForeign('mode_types_ibfk_1');
			$table->dropForeign('mode_types_ibfk_2');
		});
	}

}
