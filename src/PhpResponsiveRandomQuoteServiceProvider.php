<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use DavideCasiraghi\PhpResponsiveRandomQuote\Console\ResponsiveQuote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers\ResponsiveQuoteController;

class PhpResponsiveRandomQuoteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ResponsiveQuote::class,  //the console class
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'php-responsive-quote');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/responsive-quotes/'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../config/random-quote.php' => base_path('config/random-quote.php'),
        ], 'config');

        $this->publishes([
        __DIR__.'/../resources/assets/images' => public_path('vendor/responsive-quotes/assets/images/'),
        ], 'images');

        $this->publishes([
            __DIR__.'/../resources/assets/sass' => resource_path('sass/vendor/responsive-quotes/'),
        ], 'sass');

        //Route::get(config('random-quote.route'), ResponsiveQuoteController::class);
        Route::group(['middleware' => 'web'], function () {
            Route::resource('php-responsive-quote', ResponsiveQuoteController::class);
        });
    }

    public function register()
    {
        $this->app->bind('php-responsive-quote', function () {
            return new QuoteFactory();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/random-quote.php', 'random-quote');
    }
}
