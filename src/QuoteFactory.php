<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;

class QuoteFactory
{
    public function getRandomQuote()
    {
        return Quote::inRandomOrder()->first();
    }
}
