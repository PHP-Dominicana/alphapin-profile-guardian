<?php

namespace PHPDominicana\AlphapinProfileGuardian\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardianServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            AlphapinProfileGuardianServiceProvider::class,
        ];
    }
}
