<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;

class QuoteFactory
{
    /***************************************************************************/

    /**
     * Return a random quote.
     *
     * @return \DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote
     */
    public function getRandomQuote()
    {
        return Quote::inRandomOrder()->first();
    }

    /***************************************************************************/

    /**
     * Return the quote of the day.
     *
     * @return \DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote
     */
    public function getQuoteOfTheDay()
    {
        $numberOfQuotesInDB = Quote::count();
        $quoteOfTheDayNumber = rand(1, $numberOfQuotesInDB);

        $quotes = Quote::all();

        return  $quotes[$quoteOfTheDayNumber];
    }

    public function setCookie(Request $request)
    {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('quoteOfTheDayId', 'MyValue', $minutes));

        return $response;
    }

    public function getCookie(Request $request)
    {
        $value = $request->cookie('quoteOfTheDayId');
        echo $value;
    }
}
