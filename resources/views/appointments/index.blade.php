@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-4"><h3>Appointments</h3></div>

    <table id="appointments-table" class="display">
        <thead>
            <tr>
                <th class="col-1">Client</th>
                <th class="col-1">Consultant</th>
                <th class="col-1">Date</th>
                <th class="col-1">Day of week</th>
                <th class="col-1">Start time</th>
                <th class="col-1">End time</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->client->first_name . " " . $appointment->client->last_name }}</td>
                <td>{{ $appointment->consultant->first_name . " " . $appointment->consultant->last_name }}</td>
                <td>
                    <?php
                        $date = date_create($appointment->date);
                    ?>
                    {{ date_format($date, "d.m.Y") }}
                </td>
                <td>
                    <?php
                         $date = date_create($appointment->date);
                    ?>
                    {{ date_format($date, 'l') }}
                </td>
                <td>
                    <?php
                        $start_time = date_create($appointment->start_time);
                    ?>
                    {{ date_format($start_time, 'H:i') }}
                </td>
                <td>
                    <?php
                        $end_time = date_create($appointment->end_time);
                    ?>
                    {{ date_format($end_time, 'H:i') }}</td>
                <td>
                    <a href="{{ route('appointments.edit', ['appointment' => $appointment->id]) }}"
                        class="btn btn-primary">
                        Edit
                    </a>
                </td>
                <td>
                    <form method="POST" class="fm-inline" action="{{ route('appointments.destroy', ['appointment' => $appointment->id]) }}">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Delete!" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="8">
                        No appointments yet!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        $(document).ready( function () {
            $('#appointments-table').DataTable();
        } );
    </script>

@endsection('content')