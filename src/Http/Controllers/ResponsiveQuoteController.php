<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Http\Controllers;

use Orchestra\Testbench\TestCase;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\Quote;
use DavideCasiraghi\PhpResponsiveRandomQuote\Models\QuoteTranslation;
use DavideCasiraghi\PhpResponsiveRandomQuote\Facades\PhpResponsiveQuote;
use Illuminate\Http\Request;

class ResponsiveQuoteController
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
            ResponsiveGalleryServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'PhpResponsiveQuote' => PhpResponsiveQuote::class, // facade called PhpResponsiveQuote and the name of the facade class
        ];
    }
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         
         /*$searchKeywords = $request->input('keywords');

         if ($searchKeywords) {
             $galleryImages = GalleryImage::orderBy('file_name')
                                     ->where('file_name', 'like', '%'.$request->input('keywords').'%')
                                     ->paginate(20);
         } else {
             $galleryImages = GalleryImage::orderBy('file_name')
                                     ->paginate(20);
         }*/

         /*return view('php-responsive-quote::index', compact('galleryImages'))
                             ->with('i', (request()->input('page', 1) - 1) * 20)
                             ->with('searchKeywords', $searchKeywords);*/
        return view('php-responsive-quote::index');                     
     }
    
     /***************************************************************************/

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('php-responsive-quote::create');
     }
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRandomQuote()
    {
        
        $quote = PhpResponsiveQuote::getRandomQuote();

        // the view name is set in the - Service provider - boot - loadViewsFrom
        return view('php-responsive-quote::show-random-quote', [
            'quoteAuthor' => $quote['author'],
            'quoteText' => $quote['text'],
        ]);
    }
    
}
