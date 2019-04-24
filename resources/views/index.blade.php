@extends('php-responsive-quote::layout')

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-6">
            <h4>Quotes list</h4>
        </div>
        <div class="col-12 col-sm-6 mt-4 mt-sm-0 text-right">
            <a class="btn btn-success create-new" href="{{ route('php-responsive-quote.create') }}">Add new quote</a>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    
    {{-- List all the quotes --}}
    <div class="quotesList my-4">
        
        {{--
        @foreach ($quotes as $quote)
            <div class="row bg-white shadow-1 rounded mb-3 pb-2 pt-3 mx-1">
                
                <div class="col-12 py-1">
                    <h5>{{ $quote->author }}</h5>
                    <div class="">
                        {{ $quote->text }}
                    </div>
                </div>
                
                <div class="col-12 pb-2">
                    <form action="{{ route('php-responsive-quote.destroy',$quote->id) }}" method="POST">
                        <a class="btn btn-primary float-right" href="{{ route('php-responsive-quote.edit',$quote->id) }}">Edit</a>
                        
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-link pl-0">Delete</button>
                    </form>
                </div>
                
            </div>
        @endforeach
        --}}
        
        
        @foreach ($quotes as $quote)
                <div class="row bg-white shadow-1 rounded mb-3 mx-1">
                    
                    <div class="col-12 pb-2 pt-3 px-3">
                        <div class="row">
                            
                            {{-- Title --}}
                            <div class="col-12 py-1 title">
                                <h5 class="darkest-gray">{{ $quote->author }}</h5>
                            </div>
                            <div class="col-12">
                                @if($quote->translate('en')->text){{ $quote->translate('en')->text }}@endif
                            </div>
                            
                            {{-- Translations --}}
                            <div class="col-12 mb-4 mt-4">
                                @foreach ($countriesAvailableForTranslations as $key => $countryAvTrans)
                                    @if($quote->hasTranslation($key))
                                        <a href="/postTranslations/{{ $quote->id }}/{{ $key }}/edit" class="bg-success text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @else
                                        <a href="/postTranslations/{{ $quote->id }}/{{ $key }}/create" class="bg-secondary text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-12 pb-2 action">
                                <form action="{{ route('php-responsive-quote.destroy',$quote->id) }}" method="POST">

                                    <a class="btn btn-primary float-right" href="{{ route('php-responsive-quote.edit',$quote->id) }}">@lang('views.edit')</a>
                                    <a class="btn btn-outline-primary mr-2 float-right" href="{{ route('php-responsive-quote.show',$quote->id) }}">@lang('views.view')</a>
                                    
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-link pl-0">@lang('views.delete')</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>    
            @endforeach    
        
        
        
                      
    </div>

@endsection
