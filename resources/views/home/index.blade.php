@extends('layouts.app')

@section('title', 'Home page')

@section('content')
    <div class="row">
        <div class="col-4 d-flex">
            <div class="card" style="width: 18rem; height:23rem; margin-left:5rem; margin-top:5rem">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center"><strong>Clients</strong></h5>
                  <div class="card-text pt-4">
                    <p>To use the application use the navbar and check: <i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Clients</strong></p>
                    <p>You can:</p>
                    <ul>
                         <li>Add a client </li>
                         <li>Consult the list of clients</li>
                    </ul>
                    <p class="d-flex justify-content-center">See the list of clients:</p>
                  </div>
                  <div class="d-flex justify-content-center"><a href="{{ route('clients.index') }}" class="btn btn-primary">Clients</a></div>
                </div>
              </div>
        </div>

        <div class="col-4 d-flex">
            <div class="card" style="width: 18rem; height:23rem; margin-left:5rem; margin-top:5rem">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center"><strong>Consultants</strong></h5>
                  <div class="card-text pt-4">
                    <p>To use the application use the navbar and check: <i class="fa fa-graduation-cap" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Consultants</strong></p>
                    <p>You can:</p>
                    <ul>
                         <li>Add a consultant </li>
                         <li>Consult the list of consultants</li>
                    </ul>
                    <p class="d-flex justify-content-center">See the list of consultants:</p>
                  </div>
                  <div class="d-flex justify-content-center"><a href="{{ route('consultants.index') }}" class="btn btn-primary">Consultants</a></div>
                </div>
              </div>
        </div>

        <div class="col-4 d-flex">
            <div class="card" style="width: 18rem; height:23rem; margin-left:5rem; margin-top:5rem">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center"><strong>Appointments</strong></h5>
                  <div class="card-text pt-4">
                    <p>To use the application use the navbar and check: <i class="fa fa-calendar-plus-o" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Appointments</strong></p>
                    <p>You can:</p>
                    <ul>
                         <li>Add a appointment </li>
                         <li>Consult the list of appointments</li>
                         <li>View an appointment report</li>
                    </ul>
                    <p class="d-flex justify-content-center">See the list of appointments:</p>
                  </div>
                  <div class="d-flex justify-content-center"><a href="{{ route('appointments.index') }}" class="btn btn-primary">Appointments</a></div>
                </div>
              </div>
        </div>
</div>
@endsection