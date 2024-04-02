<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConvocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('convocations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_plainte')->index('id_user');
			$table->date('date');
			$table->string('observation')->nullable();
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
		Schema::drop('convocations');
	}

}
