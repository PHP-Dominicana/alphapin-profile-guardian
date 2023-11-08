<?php

namespace PHPDominicana\AlphapinProfileGuardian\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian
 */
class AlphapinProfileGuardian extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PHPDominicana\AlphapinProfileGuardian\AlphapinProfileGuardian::class;
    }
}
