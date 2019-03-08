<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote;

//use GuzzleHttp\Client;

class QuoteFactory
{
    /*const API_ENDPOINT = 'http://api.icndb.com/jokes/random/';
    protected $client;*/
        
    /*protected $quotes = array(
        'Dr. Ida Rolf' => 'We want to get into the place where gravity reinforces and is a friend, a nourishing force.', 
        'Moshe Feldenkreis' => 'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.', 
        'Michelangelo' => 'I saw the angel in the marble and carved until I set him free', 
        'Anonymus' => 'Energy flows where attention goes', 
        'Anonymus' => 'The battle is already decided before you start. Because all the movements are already in you.',
        'Joseph Heller' => 'Depending on the structure of the body on which it acts, gravity can either support us and provide a springboard for our activities or it can pull at us and tear us down.',
        'Lao Tsu' => 'All actions begins in rest.',
    ); */
    
    protected $quotes = array(
        0 => array(
            'author' => 'Dr. Ida Rolf',
            'text' => 'We want to get into the place where gravity reinforces and is a friend, a nourishing force.',
        ),
        1 => array(
            'author' => 'Moshe Feldenkreis',
            'text' => 'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.',
        ),
        2 => array(
            'author' => 'Michelangelo',
            'text' => 'I saw the angel in the marble and carved until I set him free',
        ),
        3 => array(
            'author' => 'Anonymus',
            'text' => 'Energy flows where attention goes',
        ),
        4 => array(
            'author' => 'Lao Tsu',
            'text' => 'All actions begins in rest.',
        ),
    );
    

    public function __construct(array $quotes = null)
    {
        if ($quotes) {
            $this->quotes = $quotes;
        }
    }
    /*public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }*/

    public function getRandomQuote()
    {
        //dd($this->quotes[array_rand($this->quotes)]);
        return $this->quotes[array_rand($this->quotes)];
        
        //$response = $this->client->get(self::API_ENDPOINT);
        //$joke = json_decode($response->getBody()->getContents());
        //return htmlspecialchars_decode($joke->value->joke);
    }
}
