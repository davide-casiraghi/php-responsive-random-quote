<?php 

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Tests;

use DavideCasiraghi\PhpResponsiveRandomQuote\QuoteFactory;
use PHPUnit\Framework\TestCase;

class QuoteFactoryTest extends TestCase
{
        /** @test */
        public function it_return_a_random_quote()
        {
            $wiseQuotes = [
                'We want to get into the place where gravity reinforces and is a friend, a nourishing force.',
                'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.',
                'I saw the angel in the marble and carved until I set him free',
                'Energy flows where attention goes',
                'The battle is already decided before you start. Because all the movements are already in you.',
                'Depending on the structure of the body on which it acts, gravity can either support us and provide a springboard for our activities or it can pull at us and tear us down.',
                'Your stability relies in appropriate relationships, and that is all.',
                'One thing goes awry, and its effects go on and on and on and on.',
                'The body process it is not linear, it is circular; always, it is circular.',
            ];
            
                $quotes = new QuoteFactory();
                $quote = $quotes->getRandomQuote();
                
                // We assert that the $wiseQuotes array contains the random quote picked from the array in the QuoteFactory
                    $this->assertContains($quote, $wiseQuotes);  
        }
        
        /** @test */
        public function it_return_a_predefined_quote()
        {
                $quotes = new QuoteFactory([
                    'This is a quote',
                ]);
                $quote = $quotes->getRandomQuote();
                
                $this->assertSame('This is a quote', $quote);
        }
}
