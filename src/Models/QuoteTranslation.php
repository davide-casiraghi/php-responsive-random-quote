<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteTranslation extends Model
{
    //protected $table = 'gallery_images';

    public $timestamps = false;
    protected $fillable = [
        'text'
    ];

}
