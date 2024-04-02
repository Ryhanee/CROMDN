<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDelegationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delegations', function(Blueprint $table)
		{
			$table->foreign('ref_gouvernaurat', 'delegations_ibfk_1')->references('id')->on('gouvernorats')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delegations', function(Blueprint $table)
		{
			$table->dropForeign('delegations_ibfk_1');
		});
	}

}
