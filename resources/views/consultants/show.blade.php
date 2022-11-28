@extends('layouts.app')

@section('content')
    <h1>{{ $consultant->first_name . " " . $consultant->last_name}}</h1>
    <p>{{ $consultant->email }}</p>
    <p>{{ $consultant->phone }}</p>

    <p>Added {{ $consultant->created_at->diffForHumans() }}</p>

@endsection('content')