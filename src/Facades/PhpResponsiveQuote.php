<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Facades;

use Illuminate\Support\Facades\Facade;

class PhpResponsiveQuote extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'php-responsive-quote';
    }
}
