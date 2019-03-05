<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Console;

use Illuminate\Console\Command;

class ResponsiveQuote extends Command
{
    protected $signature = 'php-responsive-quote';

    protected $description = 'Output a responsive quote';

    public function handle()
    {
        $this->info(PhpResponsiveQuote::getRandomQuote());
    }
}
