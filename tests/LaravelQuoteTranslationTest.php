<?php

namespace Davidecasiraghi\PhpResponsiveRandomQuote\Tests;

use Orchestra\Testbench\TestCase;
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

    /** @test */
    public function the_route_edit_translation_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test text',
            'locale' => 'en',
        ]);

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test spanish text',
            'locale' => 'es',
        ]);

        $this->get('php-responsive-quote-translation/'.$id.'/es/edit')
            ->assertViewIs('php-responsive-quote::quoteTranslations.edit')
            ->assertViewHas('quoteId')
            ->assertViewHas('languageCode')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_store_translation_can_be_accessed()
    {
        $id = Quote::insertGetId([
            'author' => 'test author name',
        ]);

        $data = [
            'quote_id' => $id,
            'language_code' => 'es',
            'text' => 'test translation text',
        ];

        $this
            ->followingRedirects()
            ->post('/php-responsive-quote-translation', $data);

        $this->assertDatabaseHas('quote_translations', ['text' => 'test translation text']);
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

        QuoteTranslation::insert([
            'quote_id' => $id,
            'text' => 'test spanish text',
            'locale' => 'es',
        ]);

        $this->delete('php-responsive-quote-translation/'.$id)
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

        $translationId = QuoteTranslation::insertGetId([
            'quote_id' => $id,
            'text' => 'test spanish text',
            'locale' => 'es',
        ]);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'quote_translation_id' => $translationId,
            'quote_id' => $id,
            'text' => 'test spanish text updated',
            'language_code' => 'es',
         ]);

        //dd($request);
        /*$this->followingRedirects()
             ->put('php-responsive-quote-translation/'.$translationId, [$request, $translationId])->dump();
             //->assertStatus(302);*/

        $this->put('php-responsive-quote-translation/'.$translationId, [$request, $translationId])
                  ->assertStatus(302);

        //$this->assertDatabaseHas('quote_translations', ['text' => 'test spanish text updated']);
    }
}
