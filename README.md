[![StyleCI](https://styleci.io/repos/173717359/shield?style=flat-square)](https://styleci.io/repos/173717359)
<a href="https://travis-ci.org/davide-casiraghi/php-responsive-random-quote"><img src="https://travis-ci.org/davide-casiraghi/php-responsive-random-quote.svg" alt="Build Status"></a>
[![Quality Score](https://img.shields.io/scrutinizer/g/davide-casiraghi/php-responsive-random-quote.svg?style=flat-square)](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote)
[![Coverage Status](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/davide-casiraghi/php-responsive-random-quote/)
<a href="https://codeclimate.com/github/davide-casiraghi/php-responsive-random-quote/maintainability"><img src="https://api.codeclimate.com/v1/badges/4edf745f2b64f7f0a53c/maintainability" /></a>
[![GitHub last commit](https://img.shields.io/github/last-commit/davide-casiraghi/php-responsive-random-quote.svg)](https://github.com/davide-casiraghi/php-responsive-random-quote) 

# Reponsive Random Quotes

Show a random quote or the quote of the day in your PHP project.

## Installation

Require the package using composer:

```bash
composer require davide-casiraghi/php-responsive-random-quote
```

## Publish the files from the service provider
```bash
php artisan vendor:publish --force
```
And then pick the number of our service provider.


## Usage

```php
use DavideCasiraghi\PhpResponsiveRandomQuote\QuoteFactory;

$quotes = new QuoteFactory();

$quote = $quotes->getRandomQuote();
```
Then in any blade file is possible include the view like this:
```php
@include('vendor.responsive-quotes.show', [
   'quoteAuthor' => $quote['text'],
   'quoteText' => $quote['author'],
])
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
