<?php

namespace DavideCasiraghi\PhpResponsiveRandomQuote\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //protected $table = 'gallery_images';

    use Translatable;

    public $translatedAttributes = ['text'];
    protected $fillable = [
        'author'
    ];

    /* public $guarded = [];

     */
}
