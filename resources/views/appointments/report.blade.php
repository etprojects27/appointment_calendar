@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-4"><h3>Appointments Report</h3></div>

    <div class="col-4">
    <form method="POST" action="{{ route('appointments.report_search') }}">
        @csrf
        
        <div class="form-group">
            <label>Consultant</label>
            <select class="form-select" aria-label="Default select example" name="consultant_id" id="consultant_id">
                <option value="0">-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date" class="col-sm-1 col-form-label"><div class="d-flex flex-row">Date</div></label>
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="date" name="date" value="">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>
        </div>
        
        <div class="d-flex justify-content-end mt-3"><button type="submit" class="btn btn-primary btn-block">Search</button></div>
    </form>
    </div>

    @if (Session::get('consultant'))
        <div class="d-flex justify-content-center mt-4"><h3>Consultant: {{ Session::get('consultant')}}</h3></div>
    @endif
    @if (Session::get('date'))
        <div class="d-flex justify-content-center mt-4"><h3>Date: {{ Session::get('date') }}</h3><br></div>
    @endif

    <table id="appointments-report-table" class="display">
        <thead>
            <tr>
                <th class="col-1">Client First Name</th>
                <th class="col-1">Client Last Name</th>
                <th class="col-1">Start Time</th>
                <th class="col-1">End Time</th>
            </tr>
        </thead>
        <tbody>
            @if (Session::get('appointments'))
                <?php 
                    $appointments = Session::get('appointments'); 
                ?>
                @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->client->first_name }}</td>
                    <td>{{ $appointment->client->last_name }}</td>
                    <td>
                        <?php 
                            $start_time_unformatted = date_create($appointment->start_time);
                            $start_time_formatted = date_format($start_time_unformatted, "H:i")
                        ?>
                        {{ $start_time_formatted }}
                    </td>
                    <td>
                        <?php 
                            $end_time_unformatted = date_create($appointment->end_time);
                            $end_time_formatted = date_format($end_time_unformatted, "H:i")
                        ?>
                        {{ $end_time_formatted }}
                    </td>
                </tr>
                @empty
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            @endif
        </tbody>
    </table>

    <script>
        $(document).ready( function () {
            $(function() {
                $('#datepicker').datepicker({
                    format: 'dd.mm.yyyy',
                    daysOfWeekDisabled: [0, 6]
                });
            });

            $('#appointments-report-table').DataTable();

            const consultantsUrl = '{{ url("/consultants/getJson") }}';
            $.get(consultantsUrl, '', function (data, textStatus, jqXHR) {
                const $consultantDropdown = $('#consultant_id');
                if (data) {
                    for (let i = 0; i < data.length; i++) {
                        const consultant = data[i];
                        const $option = $('<option></option>')
                            .attr('value', consultant.id)
                            .html(consultant.first_name + ' ' + consultant.last_name);
                        $consultantDropdown.append($option);
                    }
                }
            });
        });
    </script>

@endsection('content')