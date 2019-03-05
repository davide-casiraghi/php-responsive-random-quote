<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

use Illuminate\Support\ServiceProvider;

class PhpResponsiveRandomQuoteServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind('php-responsive-quote', function () {
            return new QuoteFactory();
        });
    }
}
