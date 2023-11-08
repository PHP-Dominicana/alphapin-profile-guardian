<?php

namespace PHPDominicana\AlphapinProfileGuardian\Commands;

use Illuminate\Console\Command;

class AlphapinProfileGuardianCommand extends Command
{
    public $signature = 'alphapin-profile-guardian';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
