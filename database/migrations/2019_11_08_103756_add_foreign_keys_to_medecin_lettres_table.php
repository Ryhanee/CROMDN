<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedecinLettresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medecin_lettres', function(Blueprint $table)
		{
			$table->foreign('id_lettre', 'kp_lettre')->references('id')->on('lettres')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_medecin', 'kp_user')->references('id')->on('medecins')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medecin_lettres', function(Blueprint $table)
		{
			$table->dropForeign('kp_lettre');
			$table->dropForeign('kp_user');
		});
	}

}
