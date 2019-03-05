<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Console;

use Illuminate\Console\Command;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;

class PhpResponsiveQuote extends Command
{
    protected $signature = 'php-responsive-quote';

    protected $description = 'Output a responsive quote';

    public function handle()
    {
        $this->info(self::getRandomQuote());
    }
}
