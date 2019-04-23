<?php

    Route::group(['namespace' => 'DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers', 'middleware' => 'web'], function () {
        Route::resource('php-responsive-quote', 'ResponsiveQuoteController');
        Route::get('/random-quote/', 'ResponsiveQuoteController@showRandomQuote');
    });
