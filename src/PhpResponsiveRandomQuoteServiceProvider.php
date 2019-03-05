<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

use Illuminate\Support\ServiceProvider;
use DavideCasiraghi\PhpResponsiveRandomQuote\Console\ResponsiveQuote;

class PhpResponsiveRandomQuoteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ResponsiveQuote::class,  //the console class
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('php-responsive-quote', function () {
            return new QuoteFactory();
        });
    }
}
