<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDelegationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delegations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('libelle');
			$table->integer('ref_gouvernaurat')->index('ref_gouvernaurat');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('delegations');
	}

}
