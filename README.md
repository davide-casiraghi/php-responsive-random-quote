[![StyleCI](https://styleci.io/repos/173717359/shield?style=flat-square)](https://styleci.io/repos/173717359)
[![GitHub last commit](https://img.shields.io/github/last-commit/davide-casiraghi/php-responsive-random-quote.svg)](https://github.com/davide-casiraghi/php-responsive-random-quote) 

# Reponsive Random Quotes

Show a random quote or the quote of the day in your PHP project.

## Installation

Require the package using composer:

```bash
composer require davide-casiraghi/php-responsive-random-quote
```

## Usage

```php
use DavideCasiraghi\PhpResponsiveRandomQuote\QuoteFactory;

$quotes = new QuoteFactory();

$quote = $quotes->getRandomQuote();
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
