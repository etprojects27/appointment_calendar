<div class="form-group">
    <label>Client</label>
    <select class="form-select" aria-label="Default select example" name="client_id" id="client_id">  
        @forelse ($clients as $client)
            <?php
                $selected = "";
                if (old('client_id')) {
                    if (old('client_id') == $client->id) {
                        $selected = "selected";
                    }
                } elseif (isset($appointment->client_id)) {
                    if ($appointment->client_id == $client->id) {
                        $selected = "selected";
                    }
                }
            ?>
            <option value="{{ $client->id }}" {{ $selected }}> {{ $client->first_name . " " . $client->last_name}}</option>
        @empty
            <option value="0">-</option>
        @endforelse
    </select>
</div>
@error('client_id')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Consultant</label>
    <select class="form-select" aria-label="Default select example" name="consultant_id">
        @forelse ($consultants as $consultant)
        <?php
            $selected = "";
            if (old('consultant_id')) {
                if (old('consultant_id') == $consultant->id) {
                    $selected = "selected";
                }
            } elseif (isset($appointment->consultant_id)) {
                if ($appointment->consultant_id == $consultant->id) {
                    $selected = "selected";
                }
            }
        ?>
            <option value="{{ $consultant->id }}" {{ $selected }}> {{ $consultant->first_name . " " . $consultant->last_name}}</option>
        @empty
            <option value="0">-</option>
        @endforelse
    </select>
</div>
@error('consultant_id')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label for="date" class="col-sm-1 col-form-label"><div class="d-flex flex-row">Date <i class="fa fa-info-circle" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right" title="Choose a date from Monday to Friday" style="margin-top: 0.28rem; margin-left:0.4rem; color:red"></i></div></label>
        <div class="input-group date" id="datepicker">
            <?php
               $date = "";
               if (old('date')){
                 $date = old('date');
               } else if (isset($appointment->date)) {
                 $date_unformatted = date_create($appointment->date);
                 $date = date_format($date_unformatted, "d.m.Y");
               }
            ?>
            <input type="text" class="form-control" id="date" name="date" value="{{ $date }}">
            <span class="input-group-append">
                <span class="input-group-text bg-white">
                    <i class="fa fa-calendar"></i>
                </span>
            </span>
        </div>
</div>
@error('date')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>Day of week</label>
    <?php
        $day_of_week = " ";
        if (old('date')) {
            $day_of_week_unformatted = date_create(old('date'));
            $day_of_week = date_format($day_of_week_unformatted, 'l');
        } elseif (isset($appointment->date)) {
            $day_of_week_unformatted = date_create($appointment->date);
            $day_of_week = date_format($day_of_week_unformatted, 'l');
        }
    ?>
    <input type="text" id="day-of-week" name="day_of_week" class="form-control" style="width: 40%"  disabled value="{{ $day_of_week }}" />
</div>

<div class="form-group">
    <label>Start time <i class="fa fa-info-circle" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right" title="Choose a start time between 9:00 - 12:00 or 15:30 - 20:00" style="margin-top: 0.28rem; margin-left:0.4rem; color:red"></i></label>
    <div class="row">
        <select class="form-select" aria-label="Default select example" id="start-time-hour" name="start_time_hour" style="width:40%; margin-left:0.8rem">
            @forelse ($hours as $hour)
                <?php
                    $selected = "";
                    if (old('start_time_hour')) {
                        if (old('start_time_hour') == $hour) {
                            $selected = "selected";
                        }
                    } elseif (isset($appointment->start_time)) {
                        $time_unformatted = date_create($appointment->start_time);
                        if (date_format($time_unformatted, 'H') == $hour) {
                            $selected = "selected";
                        }
                    }
                ?>
                <option value="{{ $hour }}" {{ $selected }}> {{ $hour }}</option>
             @empty
                <option value="0">-</option>
             @endforelse
        </select>

        <select class="form-select col-1" aria-label="Default select example" id="start-time-minutes" name="start_time_minutes" style="width:40%; margin-left:1rem">
            @forelse ($minutes as $minute)
                <?php
                    $selected = "";
                    if (old('start_time_minutes')) {
                        if (old('start_time_minutes') == $minute) {
                            $selected = "selected";
                        }
                    } elseif (isset($appointment->start_time)) {
                        $time_unformatted = date_create($appointment->start_time);
                        if (date_format($time_unformatted, 'i') == $minute) {
                            $selected = "selected";
                        }
                    }
                ?>
                <option value="{{ $minute }}" {{ $selected }}> {{ $minute }}</option>
             @empty
                <option value="0">-</option>
             @endforelse
        </select>
    </div>
</div>
@error('start_time_hour')
    <span style="color: red">{{ $message }}</span>
@enderror
@error('start_time_minutes')
    <span style="color: red">{{ $message }}</span>
@enderror

<div class="form-group">
    <label>End time <i class="fa fa-info-circle" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right" title="The duration of an appointment is 1 hour" style="margin-top: 0.28rem; margin-left:0.4rem; color:green"></i></label>
    <div class="row">
        <?php
            $end_time_hour = "";
            if (old('start_time_hour')) {
                $end_time_hour = old('start_time_hour') + 1;
            } elseif (isset($appointment->end_time)) {
                $time_unformatted = date_create($appointment->end_time);
                $end_time_hour = date_format($time_unformatted, 'H');
            }

            $end_time_minutes = "";
            if (old('start_time_minutes')) {
                $end_time_minutes = old('start_time_minutes');
            } elseif (isset($appointment->end_time)) {
                $time_unformatted = date_create($appointment->end_time);
                $end_time_minutes = date_format($time_unformatted, 'i');
            }
        ?>
        <input type="text" id="end-time-hour" name="end_time_hour" class="form-control" value="{{ $end_time_hour }}" style="width: 40%; margin-left:0.8rem"  disabled/>
        <input type="text" id="end-time-minutes" name="end_time_minutes" class="form-control" value="{{ $end_time_minutes }}" style="width: 40%; margin-left:1rem"  disabled/>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            format: 'dd.mm.yyyy',
            daysOfWeekDisabled: [0, 6]
        });
    });

    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('#end-time-hour').val("10");
        $('#end-time-minutes').val("00");

        $('#date').on('keyup change', function(evt) { 
            let date_string = String(this.value);
            
            const myArrayDate = date_string.split(".");
            let date_formatted = myArrayDate[1] + "-" + myArrayDate[0] + "-" + myArrayDate[2];
            let date = new Date(date_formatted);

            let weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let weekday = weekdays[date.getDay()];

            $('#day-of-week').val(weekday);
        });

        $('#start-time-hour').on('keyup change', function(evt) { 
            let minutes = $('#start-time-minutes').val();
            let hour_int = parseInt(this.value);
            let next_hour = hour_int + 1;

            $('#end-time-hour').val(String(next_hour));
            $('#end-time-minutes').val(minutes);
        });

        $('#start-time-minutes').on('keyup change', function(evt) { 
            let minutes = $('#start-time-minutes').val();
            let hour = $('#start-time-hour').val();
            let hour_int = parseInt(hour);
            let next_hour = hour_int + 1;

            $('#end-time-hour').val(String(next_hour));
            $('#end-time-minutes').val(minutes);
        });

        // const clientsUrl = '{{ url("/clients/getJson") }}';
        // $.get(clientsUrl, '', function (data, textStatus, jqXHR) {
        //     const $clientDropdown = $('#client_id');
        //     if (data) {
        //         for (let i = 0; i < data.length; i++) {
        //             const client = data[i];
        //             const $option = $('<option></option>')
        //                 .attr('value', client.id)
        //                 .html(client.first_name + ' ' + client.last_name);
        //             $clientDropdown.append($option);
        //         }
        //     }
        // });
    });

</script>