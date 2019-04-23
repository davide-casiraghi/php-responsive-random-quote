@extends('php-responsive-quote::layout')

@section('content')
    {{$quote->author}}
    {{$quote->text}}
@endsection
