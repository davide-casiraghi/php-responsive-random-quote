<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteTranslation extends Model
{
    protected $table = 'quote_translations';

    public $timestamps = false;
    protected $fillable = [
        'text',
    ];
}
