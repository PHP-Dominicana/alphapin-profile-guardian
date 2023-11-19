<?php

namespace PHPDominicana\AlphapinProfileGuardian\Tests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;
use PHPDominicana\AlphapinProfileGuardian\Database\Factories\UserFactory;
use PHPDominicana\AlphapinProfileGuardian\Tests\App\Models\User;
use PHPDominicana\AlphapinProfileGuardian\Tests\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

beforeEach(function () {
	// Set up your SQLite in-memory database
	$capsule = new Capsule;
	$capsule->addConnection([
								'driver'   => 'sqlite',
								'database' => ':memory:',
								'prefix'   => '',
							]);
	$capsule->setAsGlobal();
	$capsule->bootEloquent();

	// Run your migrations
	include_once __DIR__.'/../../database/migrations/create_alphapin_profile_guardian_table.php.stub';

});
function createUsersTable()
{
	Capsule::schema()->dropIfExists('users'); // Drop the table if it exists
	Capsule::schema()->create('users', function (Blueprint $table) {
		$table->id();
		$table->string('name');
		$table->string('email')->unique();
		$table->timestamps();
	});
}

function createAlphapinProfileGuardianTable()
{
	Capsule::schema()->dropIfExists('alphapin_profile_guardian'); // Drop the table if it exists
	Capsule::schema()->create('alphapin_profile_guardian', function (Blueprint $table) {
		$table->id();
		$table->string('user_id');
		$table->string('email');
		$table->string('pin');
		$table->timestamp('pin_expiration');
		$table->string('type');
		$table->timestamp('last_used_at')->nullable();
		$table->timestamp('expires_at')->nullable();
		$table->timestamps();
	});
}

it('can create a new post', function () {
	// Your test logic goes here
	createUsersTable();
	$user = User::create([
					 'name' => 'John Doe',
					 'email' => 'johndoe@emai.com',
				 ]);

$this->assertNotEmpty($user);
	// Assertions go here
	// $this->assertDatabaseCount('users', 1);
	// $this->assertDatabaseHas('users', ['name' => 'John Doe']);
});

test('testing generate pin (feature)', function () {

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();

	expect(strlen($pin))->toBe(6);
});

it('can send email', function () {
	uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

	// \Pest\Laravel\artisan('migrate:fresh');
	createUsersTable();
	createAlphapinProfileGuardianTable();
	// $stub = $this->createMock(User::class);
	// $user = UserFactory::new()->create();
	// print_r($user);
	// $user = new User(1, 'John Doe', 'john@doe.com');
	// $user = User::create([
	// 						 'name' => 'John Doe',
	// 						 'email' => 'john@doe.com',
	// 					 ]);
	$user = User::create([
							 'name' => 'John Doe',
							 'email' => 'johndoe@emai.com',
						 ]);
	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();
	$result = $alphapinProfileGuardian->sendPin($pin, $user);
	dd($result);

})->expect(true);

