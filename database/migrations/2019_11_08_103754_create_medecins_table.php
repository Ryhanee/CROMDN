<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedecinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medecins', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('email', 100)->index('users_email_unique');
			$table->string('password')->nullable();
			$table->string('nom');
			$table->string('prenom');
			$table->date('date_naissance');
			$table->string('lieu_naissance')->nullable();
			$table->string('gsm', 100)->nullable();
			$table->string('fixe', 100)->nullable();
			$table->string('fax', 100)->nullable();
			$table->integer('sexe');
			$table->string('adresse');
			$table->integer('id_ville')->index('id_ville');
			$table->integer('id_delegation')->index('id_delegation');
			$table->integer('id_gouvernorat')->index('id_gouvernorat');
			$table->integer('id_nationalite')->index('id_nationalite');
			$table->integer('etat_actuel');
			$table->integer('id_exercice')->nullable()->index('id_exercice');
			$table->integer('id_mode')->index('id_mode_2');
			$table->integer('id_type_mode')->nullable()->index('id_type_mode');
			$table->integer('id_specialite')->index('id_specialite');
			$table->integer('id_diplome')->index('id_diplome');
			$table->date('annee_diplome');
			$table->date('date_inscription')->nullable();
			$table->date('date_ouverture')->nullable();
			$table->date('date_reinscription')->nullable();
			$table->string('epouse')->nullable();
			$table->string('site_web')->nullable();
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
		Schema::drop('medecins');
	}

}
