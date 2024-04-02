<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVillesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('villes', function(Blueprint $table)
		{
			$table->foreign('ref_delegation', 'villes_ibfk_2')->references('id')->on('delegations')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('villes', function(Blueprint $table)
		{
			$table->dropForeign('villes_ibfk_2');
		});
	}

}
