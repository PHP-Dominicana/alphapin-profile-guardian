<?php

namespace PHPDominicana\AlphapinProfileGuardian\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardianServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends Orchestra
{
	protected function setUp(): void
	{
		parent::setUp();

		Factory::guessFactoryNamesUsing(
			fn (string $modelName) => 'VendorName\\Skeleton\\Database\\Factories\\'.class_basename($modelName).'Factory'
		);
	}

	protected function getPackageProviders($app)
	{
		return [
			AlphapinProfileGuardianServiceProvider::class,
		];
	}

	public function getEnvironmentSetUp($app)
	{
		config()->set('database.default', 'testing');

		$migration = include __DIR__.'/../database/migrations/create_alphapin_profile_guardian_table.php.stub';
		$migration->up();

	}
}