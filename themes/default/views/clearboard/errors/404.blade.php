@extends('clearboard.common.template')

@section('title', '404 Not Found')

@section('content')
    <h1>404 Not Found</h1>
    <p>The page you requested doesn't exist.</p>
    <ul>
        <li><a href="{{ url('/') }}">Goto the homepage</a></li>
        <li><a href="javascript:void(0);" onclick="history.back()">Go back</a></li>
    </ul>
@endsection


