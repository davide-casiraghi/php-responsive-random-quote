<?php

    Route::group(['namespace' => 'DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers', 'middleware' => 'web'], function () {
        
        /* Quotes */
        Route::resource('php-responsive-quote', 'ResponsiveQuoteController');
        Route::get('/random-quote/', 'ResponsiveQuoteController@showRandomQuote');
        
        /* Quote translations */
        Route::get('php-responsive-quote-translation/{quoteId}/{languageCode}/create', 'ResponsiveQuoteTranslationController@create')->name('php-responsive-quote-translation.create');
        Route::get('php-responsive-quote-translation/{quoteId}/{languageCode}/edit', 'ResponsiveQuoteTranslationController@edit')->name('php-responsive-quote-translation.edit');
        Route::resource('php-responsive-quote-translation', 'ResponsiveQuoteTranslationController')->except(['create','edit']);
    });
