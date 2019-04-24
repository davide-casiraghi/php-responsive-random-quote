<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

//use GuzzleHttp\Client;

class QuoteFactory
{

    protected $quotes = [
        0 => [
            'author' => 'Dr. Ida Rolf',
            'text' => 'We want to get into the place where gravity reinforces and is a friend, a nourishing force.',
        ],
        1 => [
            'author' => 'Moshe Feldenkreis',
            'text' => 'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.',
        ],
        2 => [
            'author' => 'Michelangelo',
            'text' => 'I saw the angel in the marble and carved until I set him free',
        ],
        3 => [
            'author' => 'Anonymus',
            'text' => 'Energy flows where attention goes',
        ],
        4 => [
            'author' => 'Lao Tsu',
            'text' => 'All actions begins in rest.',
        ],
    ];

    public function __construct(array $quotes = null)
    {
        if ($quotes) {
            $this->quotes = $quotes;
        }
    }

    public function getRandomQuote()
    {
        //dd($this->quotes[array_rand($this->quotes)]);
        return $this->quotes[array_rand($this->quotes)];
    }
}
