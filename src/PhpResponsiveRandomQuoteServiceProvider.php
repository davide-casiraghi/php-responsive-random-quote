<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

use Carbon\Carbon;
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
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

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

        if (! class_exists('CreateQuotesTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_quotes_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_quotes_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateQuoteTranslationsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_quote_translations_table.php.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_Hmsu').'_create_quote_translations_table.php'),
            ], 'migrations');
        }

        //Route::get(config('random-quote.route'), ResponsiveQuoteController::class);
        /*Route::group(['middleware' => 'web'], function () {
            Route::resource('php-responsive-quote', ResponsiveQuoteController::class);

            //Route::get('/php-responsive-quote/random-quote/')->uses('App\Http\Controllers\ResponsiveQuoteController@showRandomQuote');
            Route::get('/php-responsive-quote/random-quote/', ResponsiveQuoteController::class);
            //Route::get('random-quote', ResponsiveQuoteController::class);
        });*/
    }

    public function register()
    {
        $this->app->bind('php-responsive-quote', function () {
            return new QuoteFactory();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/random-quote.php', 'random-quote');
    }
}
