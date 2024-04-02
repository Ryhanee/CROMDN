<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlaintesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plaintes', function(Blueprint $table)
		{
			$table->foreign('id_motif', 'plaintes_ibfk_3')->references('id')->on('motifs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_medecin', 'plaintes_ibfk_4')->references('id')->on('medecins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plaintes', function(Blueprint $table)
		{
			$table->dropForeign('plaintes_ibfk_3');
			$table->dropForeign('plaintes_ibfk_4');
		});
	}

}
