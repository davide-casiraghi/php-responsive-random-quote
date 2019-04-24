<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ResponsiveQuoteTranslationController
{
    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     * @param int $categoryId
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

    // **********************************************************************
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $categoryId
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
    
    // **********************************************************************

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

}
