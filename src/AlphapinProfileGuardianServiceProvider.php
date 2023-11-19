<?php

namespace PHPDominicana\AlphapinProfileGuardian;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PHPDominicana\AlphapinProfileGuardian\Commands\AlphapinProfileGuardianCommand;

class AlphapinProfileGuardianServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        $package
            ->name('alphapin-profile-guardian')
            ->hasConfigFile('alphapin-profile-guardian')
            ->hasViews('alphapin-profile-guardian', 'alphapin-profile-guardian')
            ->hasMigration('create_alphapin-profile-guardian_table')
            ->hasCommand(AlphapinProfileGuardianCommand::class);
    }
}
