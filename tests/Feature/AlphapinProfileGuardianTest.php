<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian;
use PHPDominicana\AlphapinProfileGuardian\Database\Factories\UserFactory;
use PHPDominicana\AlphapinProfileGuardian\Tests\TestCase;
class User {
	public int $id;
	public string $name;
	public string $email;

	public function __construct(int $id, string $name, string $email) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
	}
}

test('testing generate pin (feature)', function () {

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	$pin = $alphapinProfileGuardian->generatePIN();

	expect(strlen($pin))->toBe(6);
});

it('can send email', function () {
	uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

	\Pest\Laravel\artisan('migrate:fresh');

	// $stub = $this->createMock(User::class);
	// $user = UserFactory::new()->create();
	// print_r($user);
	$user = new \User(1, 'John Doe', 'john@doe.com');

	$alphapinProfileGuardian = new AlphapinProfileGuardian();
	return $alphapinProfileGuardian->sendPin(1, $user);


})->expect(true);

