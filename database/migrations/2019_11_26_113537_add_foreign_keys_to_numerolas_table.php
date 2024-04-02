<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNumerolasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('numerolas', function(Blueprint $table)
		{
			$table->foreign('id_medecin', 'numerolas_ibfk_1')->references('id')->on('medecins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_lettre', 'numerolas_ibfk_2')->references('id')->on('lettres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_attestation', 'numerolas_ibfk_3')->references('id')->on('attestations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('numerolas', function(Blueprint $table)
		{
			$table->dropForeign('numerolas_ibfk_1');
			$table->dropForeign('numerolas_ibfk_2');
			$table->dropForeign('numerolas_ibfk_3');
		});
	}

}
