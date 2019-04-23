<?php

namespace Davidecasiraghi\PhpResponsiveRandomQuote\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Artisan;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use DavideCasiraghi\PhpResponsiveRandomQuote\PhpResponsiveRandomQuoteServiceProvider;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;

use Illuminate\Support\Facades\DB;


class LaravelTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
    
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadLaravelMigrations(['--database' => 'testbench']);
    }
    
    protected function getPackageProviders($app)
    {
        return [
            PhpResponsiveRandomQuoteServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PhpResponsiveQuote' => PhpResponsiveQuote::class, // facade called PhpResponsiveQuote and the name of the facade class
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
        $this->assertSame('some joke'.PHP_EOL, $output);
    }

    /** @test */
    public function it_runs_the_migrations()
    {
        //dd("sss");
        
        
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
        $tables = array_map('current',$tables);
        dd($tables);
        
        
        
        Quote::insert([
            'author' => 'test author name',
            'text' => 'dummy quote',
        ]);
        
        
        
        
        dd("aaa 1");

        $quote = Quote::where('author', '=', 'test author name')->first();

        $this->assertEquals('test author name', $quote->author);
    }



    /** @test */
    public function the_route_index_can_be_accessed()
    {
        $this->get('php-responsive-quote')
            ->assertViewIs('php-responsive-quote::index')
            ->assertStatus(200);
    }
    
    /** @test */
    public function the_route_create_can_be_accessed()
    {
        $this->get('php-responsive-quote/create')
            ->assertViewIs('php-responsive-quote::create')
            ->assertStatus(200);
    }
    
    /** @test */
    /*public function the_route_store_can_be_accessed()
    {
        $data = [
            'author' => 'test author name',
            'text' => 'dummy quote',
        ];

        $this
            ->followingRedirects()
            ->post('/php-responsive-quote', $data);
            
        $this->assertDatabaseHas('quotes', ['author' => 'test author name']);
    }*/

    /** @test */
    public function the_route_random_quote_can_be_accessed()
    {
        PhpResponsiveQuote::shouldReceive('getRandomQuote')
            ->once()
            ->andReturn([
                'author' => 'Moshe Feldenkreis',
                'text' => 'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.',
            ]);

        $this->get('random-quote')
            ->assertViewIs('php-responsive-quote::show-random-quote')
            ->assertViewHas('quoteAuthor')
            ->assertViewHas('quoteText')
            ->assertStatus(200);
    }
}
