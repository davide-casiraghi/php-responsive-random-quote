<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;

class ResponsiveQuoteController
{
    public function __invoke()
    {
        //return PhpResponsiveQuote::getRandomQuote();

        return view('php-responsive-quote::joke', [
            'joke' => PhpResponsiveQuote::getRandomQuote(),
        ]);
    }
}
