<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;

class ResponsiveQuoteController
{
    /*public function __invoke()
    {
        //return PhpResponsiveQuote::getRandomQuote();
        dd("asd 1");
        return view('php-responsive-quote::show', [
            'quote' => PhpResponsiveQuote::getRandomQuote(),
        ]);
    }*/

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRandomQuote()
    {
        
        $quote = PhpResponsiveQuote::getRandomQuote();

        // the view name is set in the - Service provider - boot - loadViewsFrom
        return view('php-responsive-quote::show-random-quote', [
            'quoteAuthor' => $quote['author'],
            'quoteText' => $quote['text'],
        ]);
    }
    
}
