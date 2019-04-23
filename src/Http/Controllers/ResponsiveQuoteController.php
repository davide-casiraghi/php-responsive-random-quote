<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use Illuminate\Http\Request;

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
     public function index(Request $request)
     {
         
         /*$searchKeywords = $request->input('keywords');

         if ($searchKeywords) {
             $galleryImages = GalleryImage::orderBy('file_name')
                                     ->where('file_name', 'like', '%'.$request->input('keywords').'%')
                                     ->paginate(20);
         } else {
             $galleryImages = GalleryImage::orderBy('file_name')
                                     ->paginate(20);
         }*/

         /*return view('php-responsive-quote::index', compact('galleryImages'))
                             ->with('i', (request()->input('page', 1) - 1) * 20)
                             ->with('searchKeywords', $searchKeywords);*/
        return view('php-responsive-quote::index');                     
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
