<?php

namespace PHPDominicana\AlphapinProfileGuardian;

use PHPDominicana\AlphapinProfileGuardian\Commands\AlphapinProfileGuardianCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AlphapinProfileGuardianServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('alphapin-profile-guardian')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_alphapin-profile-guardian_table')
            ->hasCommand(AlphapinProfileGuardianCommand::class);
    }
}
