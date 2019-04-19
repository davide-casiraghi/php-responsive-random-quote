<?php 

namespace Davidecasiraghi\PhpResponsiveRandomQuote\Tests;

use DavideCasiraghi\PhpResponsiveRandomQuote\PhpResponsiveRandomQuoteServiceProvider; 
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;

use Illuminate\Support\Facades\Artisan;

use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PhpResponsiveRandomQuoteServiceProvider::class
        ];
    }
    
    protected function getPackageAliases($app)
    {
        return [
            'PhpResponsiveQuote' => ResponsiveQuote::class // facade called ResponsiveQuote and the name of the facade class
        ];
    }
    
    /** @test */
    public function the_console_command_returns_a_quote()
    {
        $this->withoutMockingConsoleOutput();
        
        PhpResponsiveQuote::shouldReceive('getRandomQuote')
            ->once()
            ->andReturn('some joke');
        
        $this->artisan('php-responsive-quote');
        $output = Artisan::output();
        $this->assertSame('some joke'.PHP_EOL,$output);
    }
    
    /** @test */
    public function the_route_can_be_accessed(){
        
        PhpResponsiveQuote::shouldReceive('getRandomQuote')
            ->once()
            ->andReturn('some joke');
        
        $this->get('php-responsive-quote')
             ->assertViewIs('php-responsive-quote::show')
             ->assertViewHas('quote')
             ->assertViewHas('quote','some joke')
             ->assertStatus(200);
    }
}
