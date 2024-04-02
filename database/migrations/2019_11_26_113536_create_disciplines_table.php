<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disciplines', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('reference', 55)->nullable();
			$table->bigInteger('id_medecin')->unsigned()->index('id_medecine');
			$table->integer('id_sanction')->index('id_sanction');
			$table->boolean('recours')->default(0);
			$table->date('date');
			$table->text('observation', 65535)->nullable();
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
		Schema::drop('disciplines');
	}

}
