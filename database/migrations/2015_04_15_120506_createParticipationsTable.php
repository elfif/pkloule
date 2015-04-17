<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            schema::create('participations', function($t){
                $t->increments('id');
                $t->integer('player_id')->index();
                $t->integer('partie_id')->index();
                $t->integer('cave');
                $t->integer('resultat')->default(0);
                $t->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
