<?php

use \App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;
use PHPDominicana\AlphapinProfileGuardian\Database\Factories\UserFactory;
use PHPDominicana\AlphapinProfileGuardian\Tests\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

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

it('can create a new post', function () {
	// Your test logic goes here
	$user = User::create([
					 'name' => 'John Doe',
					 'email' => 'johndoe@emai.com',
				 ]);

	// Assertions go here
	$this->assertDatabaseCount('user', 1);
	$this->assertDatabaseHas('user', ['name' => 'John Doe']);
});

test('testing generate pin (feature)', function () {

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();

	expect(strlen($pin))->toBe(6);
});

it('can send email', function () {
	uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

	// \Pest\Laravel\artisan('migrate:fresh');

	$stub = $this->createMock(User::class);
	$user = UserFactory::new()->create();
	// print_r($user);
	// $user = new User(1, 'John Doe', 'john@doe.com');
	// $user = User::create([
	// 						 'name' => 'John Doe',
	// 						 'email' => 'john@doe.com',
	// 					 ]);

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	return $alphapinProfileGuardian->sendPin(1, $user);


})->expect(true);

