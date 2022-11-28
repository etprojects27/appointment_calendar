@extends('layouts.app')

@section('content')
    <h1>{{ $appointment->client->first_name . " " . $appointment->consultant.last_name}}</h1>
    <p>{{ $appointment->start_time }}</p>

    <p>Added {{ $appointment->created_at->diffForHumans() }}</p>

@endsection('content')