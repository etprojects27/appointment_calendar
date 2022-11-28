<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
        <script src="{{ asset('js/app.js') }}" defer></script> --}}
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="{{ asset('build/assets/app.67dcdfd2.css') }}">
        <script src="{{ asset('build/assets/app.562bb35b.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title> @yield('title') </title>
    </head>
    <body style="background-color: white">
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home.index') }}">Appointment calendar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Clients</strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('clients.index') }}">All clients</a></li>
                      <li><a class="dropdown-item" href="{{ route('clients.create') }}">Add client</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-graduation-cap" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Consultants</strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('consultants.index') }}">All consultants</a></li>
                      <li><a class="dropdown-item" href="{{ route('consultants.create') }}">Add consultant</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-calendar-plus-o" aria-hidden="true" style="margin-right:0.2rem"></i><strong>Appointments</strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('appointments.index') }}">All appointments</a></li>
                      <li><a class="dropdown-item" href="{{ route('appointments.create') }}">Add appointment</a></li>
                      <li><a class="dropdown-item" href="{{ route('appointments.report') }}">Appointments report</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        
        @include('flash-message')

        @yield('content')
    </body>
</html>