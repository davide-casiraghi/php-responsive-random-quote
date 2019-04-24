@extends('php-responsive-quote::quotes.layout')

@section('content')
    
    <div class="row py-4">
        <div class="col-12 col-sm-9">
            <h4>Edit quote translation</h4>
        </div>
        <div class="col-12 col-sm-3 text-right">
            <span class="badge badge-secondary">{{$selectedLocaleName}}</span>
        </div>
    </div>

    @include('php-responsive-quote::partials.error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('php-responsive-quote-translation.update') }}" method="POST">
        @csrf
        @method('PUT')
            @include('php-responsive-quote::partials.input-hidden', [
                  'name' => 'quote_translation_id',
                  'value' => $quoteTranslation->id,
            ])
            @include('php-responsive-quote::partials.input-hidden', [
                  'name' => 'quote_id',
                  'value' => $quoteId,
            ])
            @include('php-responsive-quote::partials.input-hidden', [
                  'name' => 'language_code',
                  'value' => $languageCode
            ])

         <div class="row">
            <div class="col-12">
                @include('php-responsive-quote::partials.input', [
                    'title' => 'Text',
                    'name' => 'text',
                    'placeholder' => 'Quote text',
                    'value' => $eventCategoryTranslation->text,
                    'required' => true,
                ])
            </div>
            
        </div>

        @include('php-responsive-quote::partials.buttons-back-submit', [
            'route' => 'php-responsive-quote.index'  
        ])

    </form>

@endsection
