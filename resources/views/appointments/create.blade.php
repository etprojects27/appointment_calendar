@extends('layouts.app')

@section('content')
    <div class="col-4 pb-3"  style="padding-left: 1.5rem">
        <div class="d-flex justify-content-center mt-4"><h3>Add appointment</h3></div>

        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            
            @include('appointments._form')

            <div class="d-flex justify-content-end mt-3"><button type="submit" class="btn btn-primary btn-block">Create</button></div>
        </form>
    </div>
@endsection