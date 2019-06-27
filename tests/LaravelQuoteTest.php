<?php

namespace Davidecasiraghi\PhpResponsiveRandomQuote\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use DavideCasiraghi\PhpResponsiveRandomQuote\PhpResponsiveRandomQuoteServiceProvider;

class LaravelQuoteTest extends TestCase
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
            \Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class,
            \Astrotomic\Translatable\TranslatableServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PhpResponsiveQuote' => PhpResponsiveQuote::class, // facade called PhpResponsiveQuote and the name of the facade class
            'LaravelLocalization' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::class,
        ];
    }

    /***************************************************************/

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
        // Shows all the tables in the sqlite DB
        /*$tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
        $tables = array_map('current',$tables);
        dd($tables);*/

        Quote::insert([
            'author' => 'test author name',
        ]);

        $quote = Quote::where('author', '=', 'test author name')->first();

        $this->assertEquals('test author name', $quote->author);
    }

    /** @test */
    public function the_route_index_can_be_accessed()
    {
        $this->get('php-responsive-quote')
            ->assertViewIs('php-responsive-quote::quotes.index')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_create_can_be_accessed()
    {
        $this->get('php-responsive-quote/create')
            ->assertViewIs('php-responsive-quote::quotes.create')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_destroy_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);

        $this->delete('php-responsive-quote/1')
            ->assertStatus(302);
    }

    /** @test */
    public function the_route_update_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);

        $request = new \Illuminate\Http\Request();
        $request->replace([
              'author' => 'test author name updated',
              'text' => 'test text updated',
          ]);

        $this->put('php-responsive-quote/1', [$request, 1])
             ->assertStatus(302);
    }

    /** @test */
    public function the_route_store_can_be_accessed()
    {
        $data = [
            'author' => 'test author name',
            'text' => 'dummy quote',
        ];

        $this
            ->followingRedirects()
            ->post('/php-responsive-quote', $data);

        $this->assertDatabaseHas('quotes', ['author' => 'test author name']);
    }

    /** @test */
    public function the_route_show_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);

        $this->get('php-responsive-quote/1')
            ->assertViewIs('php-responsive-quote::quotes.show')
            ->assertViewHas('quote')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_edit_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);

        $this->get('php-responsive-quote/1/edit')
            ->assertViewIs('php-responsive-quote::quotes.edit')
            ->assertViewHas('quote')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_random_quote_can_be_accessed()
    {
        /*PhpResponsiveQuote::shouldReceive('getRandomQuote')
            ->once()
            ->andReturn([
                'author' => 'Moshe Feldenkreis',
                'text' => 'Another aspect of erect posture is that it is a biological quality of the human frame and there should be no sensation of any doing, holding, or effort whatsoever.',
            ]);*/

        $this->get('random-quote')
            ->assertViewIs('php-responsive-quote::show-random-quote')
            ->assertStatus(200);
        //->assertViewHas('quoteAuthor')
            //->assertViewHas('quoteText')
    }
}
