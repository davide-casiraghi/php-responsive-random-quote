<?php

namespace Davidecasiraghi\PhpResponsiveRandomQuote\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use DavideCasiraghi\PhpResponsiveRandomQuote\PhpResponsiveRandomQuoteServiceProvider;

class LaravelQuoteTranslationTest extends TestCase
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
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PhpResponsiveQuote' => PhpResponsiveQuote::class, // facade called PhpResponsiveQuote and the name of the facade class
            'LaravelLocalization' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::class,
        ];
    }

    /** @test */
    public function the_route_create_translation_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);
        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);
        
        $this->get('php-responsive-quote-translation/'.$id.'/es/create')
            ->assertViewIs('php-responsive-quote::quoteTranslations.create')
            ->assertStatus(200);
    }


}
