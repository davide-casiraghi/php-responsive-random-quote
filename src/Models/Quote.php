<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

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
