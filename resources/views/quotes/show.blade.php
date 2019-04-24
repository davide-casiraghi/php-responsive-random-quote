@extends('php-responsive-quote::quotes.layout')

@section('content')
    {{$quote->author}}
    {{$quote->text}}
@endsection
