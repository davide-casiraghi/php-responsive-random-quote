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
        
        {{--@foreach ($quotes as $quote)
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
        @endforeach--}}
        
        
        
                      
    </div>

@endsection
