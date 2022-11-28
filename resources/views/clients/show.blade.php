@extends('layouts.app')

@section('content')
    <h1>{{ $client->first_name . " " . $client->last_name}}</h1>
    <p>{{ $consultant->email }}</p>
    <p>{{ $consultant->phone }}</p>

    <p>Added {{ $client->created_at->diffForHumans() }}</p>

@endsection('content')