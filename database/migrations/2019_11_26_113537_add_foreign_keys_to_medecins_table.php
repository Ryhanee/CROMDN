<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedecinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medecins', function(Blueprint $table)
		{
			$table->foreign('id_nationalite', 'medecins_ibfk_1')->references('id')->on('nationalites')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_specialite', 'medecins_ibfk_2')->references('id')->on('specialites')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_diplome', 'medecins_ibfk_3')->references('id')->on('diplomes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_ville', 'medecins_ibfk_4')->references('id')->on('villes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_exercice', 'medecins_ibfk_5')->references('id')->on('exercices')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_delegation', 'medecins_ibfk_6')->references('id')->on('delegations')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_mode', 'medecins_ibfk_7')->references('id')->on('modes')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('id_gouvernorat', 'medecins_ibfk_8')->references('id')->on('gouvernorats')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_type_mode', 'medecins_ibfk_9')->references('id')->on('type_mode_exercices')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medecins', function(Blueprint $table)
		{
			$table->dropForeign('medecins_ibfk_1');
			$table->dropForeign('medecins_ibfk_2');
			$table->dropForeign('medecins_ibfk_3');
			$table->dropForeign('medecins_ibfk_4');
			$table->dropForeign('medecins_ibfk_5');
			$table->dropForeign('medecins_ibfk_6');
			$table->dropForeign('medecins_ibfk_7');
			$table->dropForeign('medecins_ibfk_8');
			$table->dropForeign('medecins_ibfk_9');
		});
	}

}
