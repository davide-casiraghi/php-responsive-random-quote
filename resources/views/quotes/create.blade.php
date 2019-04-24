@extends('php-responsive-quote::quotes.layout')

@section('content')

    <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Add new quote</h4>
                </div>
            </div>

            @include('php-responsive-quote::partials.error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('php-responsive-quote.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- Author  --}}
                    <div class="col-12">
                        @include('php-responsive-quote::partials.input', [
                            'title' => 'Author',
                            'name' => 'author',
                            'placeholder' => '', 
                            'value' => old('author')
                        ])
                    </div>
    
                    {{-- Text --}}
                    <div class="col-12">
                        @include('php-responsive-quote::partials.textarea-plain', [
                            'title' =>  'Text',
                            'name' => 'text',
                            'value' => old('text')
                        ])
                    </div>
        
                    <div class="col-12">
                        @include('php-responsive-quote::partials.buttons-back-submit', [
                           'route' => 'php-responsive-quote.index'  
                       ])
                    </div>
                                
                </div>
            </form>
    
    </div>
    
@endsection
