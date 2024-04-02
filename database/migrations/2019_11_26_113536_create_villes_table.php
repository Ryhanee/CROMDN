<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVillesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('villes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('libelle')->nullable()->default('NULL');
			$table->integer('code_postal')->nullable();
			$table->integer('ref_delegation')->index('ref_delegation');
			$table->integer('ref_gouvernaurat')->nullable()->index('ref_gouvernaurat');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('villes');
	}

}
