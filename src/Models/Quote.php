<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Quote extends Model
{
    protected $table = 'quotes';

    use Translatable;

    public $translatedAttributes = ['text'];
    protected $fillable = [
        'author',
    ];

    /* public $guarded = [];

     */
}
