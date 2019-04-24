<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;

class ResponsiveQuoteTranslationController
{
    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     * @param int $quoteId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function create($quoteId, $languageCode)
    {
        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('php-responsive-quote::quoteTranslations.create')
                ->with('quoteId', $quoteId)
                ->with('languageCode', $languageCode)
                ->with('selectedLocaleName', $selectedLocaleName);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $quoteId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function edit($quoteId, $languageCode)
    {
        $quoteTranslation = QuoteTranslation::where('quote_id', $quoteId)
                        ->where('locale', $languageCode)
                        ->first();

        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('php-responsive-quote::quoteTranslations.edit', compact('quoteTranslation'))
                    ->with('quoteId', $quoteId)
                    ->with('languageCode', $languageCode)
                    ->with('selectedLocaleName', $selectedLocaleName);
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

        // Validate form datas
        $validator = Validator::make($request->all(), [
                'text' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $quoteTranslation = new QuoteTranslation();

        $this->saveOnDb($request, $quoteTranslation);

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quoteTranslationId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quoteTranslationId)
    {
        request()->validate([
            'text' => 'required',
        ]);

        $quoteTranslation = QuoteTranslation::find($quoteTranslationId);

        $this->saveOnDb($request, $quoteTranslation);

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuoteTranslation  $quoteTranslation
     * @return void
     */
    public function saveOnDb($request, $quoteTranslation)
    {
        $quoteTranslation->quote_id = $request->get('quote_id');
        $quoteTranslation->locale = $request->get('language_code');

        $quoteTranslation->text = $request->get('text');
        $quoteTranslation->save();
    }

    /***************************************************************************/

    /**
     * Get the language name from language code.
     *
     * @param  string $languageCode
     * @return string
     */
    public function getSelectedLocaleName($languageCode)
    {
        $countriesAvailableForTranslations = LaravelLocalization::getSupportedLocales();
        $ret = $countriesAvailableForTranslations[$languageCode]['name'];

        return $ret;
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $quoteTranslationId
     */
    public function destroy($quoteTranslationId)
    {
        $quoteTranslation = QuoteTranslation::find($quoteTranslationId);
        $quoteTranslation->delete();

        return redirect()->route('php-responsive-quote.index')
                            ->with('success', 'Quote translation deleted succesfully');
    }
}
