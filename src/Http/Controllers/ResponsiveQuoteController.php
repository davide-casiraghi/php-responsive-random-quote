<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use Orchestra\Testbench\TestCase;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use Illuminate\Http\Request;

class ResponsiveQuoteController
{
    
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
    
     /***************************************************************************/

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('php-responsive-quote::create');
     }
     
     /***************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quote = new Quote();
        $quote->author = $request->get('author');
        $quote->text = $request->get('text');

        $quote->save();

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $country
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $quote = Quote::find($id);

        return view('php-responsive-quote::show', compact('quote'));
    }
        
    /***************************************************************************/

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
