<?php

namespace PHPDominicana\AlphapinProfileGuardian\Tests;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateAlphapinProfileGuardian extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Capsule::schema()->create('alphapin_profile_guardian', function (Blueprint $table)
		{
			$table->id();
			$table->string('user_id');
			$table->string('email');
			$table->string('pin');
			$table->timestamp('last_used_at')->nullable();
			$table->timestamp('expires_at')->nullable();
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

		Capsule::schema()->dropIfExists('alphapin_profile_guardian');
	}
}
