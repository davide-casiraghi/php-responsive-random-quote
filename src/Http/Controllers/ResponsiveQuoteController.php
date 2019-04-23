<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;

class ResponsiveQuoteController
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchKeywords = $request->input('keywords');

        if ($searchKeywords) {
            $quotes = Quote::orderBy('author')
                                     ->where('author', 'like', '%'.$request->input('keywords').'%')
                                     ->paginate(20);
        } else {
            $quotes = Quote::orderBy('author')
                                     ->paginate(20);
        }

        return view('php-responsive-quote::index', compact('quotes'))
                             ->with('i', (request()->input('page', 1) - 1) * 20)
                             ->with('searchKeywords', $searchKeywords);
        //return view('php-responsive-quote::index');
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

        // Set the default language to edit the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $quote);

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $quote = Quote::find($id);

        return view('php-responsive-quote::show', compact('quote'));
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $quote = Quote::find($id);

        return view('php-responsive-quote::edit', compact('quote'));
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);

        // Set the default language to update the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $quote);

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote updated succesfully');
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        $quote->delete();

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote deleted succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $post
     * @return void
     */
    public function saveOnDb($request, $quote)
    {
        $quote->translateOrNew('en')->text = $request->get('text');
        $quote->author = $request->get('author');
        $quote->save();
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
