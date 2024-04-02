<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etats', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('id_medecin')->unsigned()->index('id_user');
			$table->date('date');
			$table->integer('id_gouvernorat')->nullable();
			$table->integer('id_delegation')->nullable();
			$table->integer('id_ville')->nullable();
			$table->string('address');
			$table->integer('id_mode_type')->nullable();
			$table->integer('id_type')->index('id_type');
			$table->text('desc', 65535)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etats');
	}

}
