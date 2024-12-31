@extends('countries::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('countries.name') !!}</p>
@endsection
