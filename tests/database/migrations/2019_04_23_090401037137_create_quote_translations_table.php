<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();

            $table->string('text')->nullable();

            $table->string('locale')->index();
            $table->unique(['quote_id', 'locale']);
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_translations');
    }
}
