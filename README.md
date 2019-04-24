[![StyleCI](https://styleci.io/repos/173717359/shield?style=flat-square)](https://styleci.io/repos/173717359)
<a href="https://travis-ci.org/davide-casiraghi/php-responsive-random-quote"><img src="https://travis-ci.org/davide-casiraghi/php-responsive-random-quote.svg" alt="Build Status"></a>
[![Quality Score](https://img.shields.io/scrutinizer/g/davide-casiraghi/php-responsive-random-quote.svg?style=flat-square)](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote)
[![Coverage Status](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote/)
<a href="https://codeclimate.com/github/davide-casiraghi/php-responsive-random-quote/maintainability"><img src="https://api.codeclimate.com/v1/badges/4edf745f2b64f7f0a53c/maintainability" /></a>
[![GitHub last commit](https://img.shields.io/github/last-commit/davide-casiraghi/php-responsive-random-quote.svg)](https://github.com/davide-casiraghi/php-responsive-random-quote) 

# Reponsive Random Quotes

Show a random quote or the quote of the day in your PHP Laravel project.  
The package support multi language trough laravel-translatable package.

## Installation

Require the package using composer:

```bash
composer require davide-casiraghi/php-responsive-random-quote
```

## Publish the files from the service provider
```bash
php artisan vendor:publish --force
```
And then pick the number of the related service provider.

## Create the DB tables
```bash
php artisan migrate
```

## Import the _responsive-quote.scss file in /resources/scss/app.scss
```php
@import 'vendor/responsive-quotes/responsive-quote';
```

## Usage

```php
use DavideCasiraghi\PhpResponsiveRandomQuote\QuoteFactory;

$quotes = new QuoteFactory();

$quote = $quotes->getRandomQuote();
```
Then in any blade file is possible include the view like this:
```php
@include('vendor.responsive-quotes.index', [
   'quoteAuthor' => $quote['text'],
   'quoteText' => $quote['author'],
])
```

## Add quotes to the database table

The package adds in the application in which it is installed the route **/php-responsive-quote/**  
From this route it's possible to add, edit and remove the quotes and their translations.


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
