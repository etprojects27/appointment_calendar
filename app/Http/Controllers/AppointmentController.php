<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointment;
use App\Models\Client;
use App\Models\Consultant;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index', ['appointments' => Appointment::with(['client','consultant'])->get()]);
    }

    public function show($id)
    {
        return view('appointments.show', ['appointment' => Appointment::findOrFail($id)]);
    }

    public function create()
    {
        $clients = Client::all()->sortBy('last_name');
        $consultants = Consultant::all()->sortBy('last_name');

        $hours = ["09","10","11","12","15","16","17","18","19","20"];
        $minutes = ["00", "30"];

        return view('appointments.create', ['clients' => $clients, 'consultants' => $consultants, 'hours' => $hours, 'minutes' => $minutes]);
    }

    public function store(StoreAppointment $request)
    {
        //DB::enableQueryLog();
        $initialValidatedData = $request->validated();
        $validatedData = $request->validated();

        $date_unformatted = date_create($validatedData['date']);
        $date_formatted = date_format($date_unformatted,"Y-m-d");

        $validatedData['date'] = $date_formatted;

        $start_time_unformatted = date_create($validatedData['start_time_hour'] . ":" . $validatedData['start_time_minutes']);
        $start_time_formatted = date_format($start_time_unformatted,"H:i");

        $validatedData['start_time'] = $start_time_formatted;

        $timestamp_end_time = strtotime($start_time_formatted) + 60*60;
        $end_time_formatted = date('H:i', $timestamp_end_time);

        $validatedData['end_time'] = $end_time_formatted;
        
        $start = strtotime($start_time_formatted) - 30*60;
        $end = strtotime($end_time_formatted) + 30*60;

        if ($this->isWeekend($date_formatted)) {
            $request->session()->flash('error', 'Date is invalid. Please pick a date between Monday - Friday!');  
            return redirect()->back()->withInput($initialValidatedData);
        }

        if (($start_time_unformatted > date_create('12:00') && $start_time_unformatted <date_create('15:30')) || $start_time_unformatted > date_create('20:00')) {
            $request->session()->flash('error', 'Start time is invalid. Please pick a start time between 9:00 - 12:00 or 15:30 - 20:00 !');   
            return redirect()->back()->withInput($initialValidatedData);
        }

        $existingAppointmentCount = Appointment::where('date', '=', $date_formatted)
            ->where('consultant_id', '=', $validatedData['consultant_id'])
            ->where(function($q) use ($start, $end, $start_time_formatted, $end_time_formatted) {
                $q->orWhere(function($q2) use ($start, $end) {
                    $q2->where('start_time', '>=', date('H:i', $start))
                        ->where('start_time', '<', date('H:i', $end));
                })
                ->orWhere(function($q3) use ($start, $end) {
                    $q3->where('end_time', '>', date('H:i', $start))
                        ->where('end_time', '<=', date('H:i', $end));
                })
                ->orWhere(function($q4) use ($start_time_formatted, $end_time_formatted) {
                    $q4->where('start_time', '=', $start_time_formatted)
                        ->where('end_time', '=', $end_time_formatted);
                });
            })
            ->count();

        if ($existingAppointmentCount > 0) {
            $request->session()->flash('error', 'Start time is invalid - appointment already exists for that consultant. Please pick another start time!');   
            return redirect()->back()->withInput($initialValidatedData);
        }

        unset($validatedData['start_time_hour']);
        unset($validatedData['start_time_minutes']);


        $appointment = Appointment::create($validatedData);
        $request->session()->flash('success', 'Appointment was created!');
        
        return redirect()->route('appointments.index');
    }

    public function edit($id)
    {
        $clients = Client::all()->sortBy('last_name');
        $consultants = Consultant::all()->sortBy('last_name');

        $hours = ["09","10","11","12","15","16","17","18","19","20"];
        $minutes = ["00", "30"];

        $appointment = Appointment::findOrFail($id);
        return view('appointments.edit', ['appointment' => $appointment, 'clients' => $clients, 'consultants' => $consultants, 'hours' => $hours, 'minutes' => $minutes]);
    }

    public function update(StoreAppointment $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $initialValidatedData = $request->validated();
        $validatedData = $request->validated();

        $validatedData = $request->validated();

        $date_unformatted = date_create($validatedData['date']);
        $date_formatted = date_format($date_unformatted,"Y-m-d");

        $validatedData['date'] = $date_formatted;

        $start_time_unformatted = date_create($validatedData['start_time_hour'] . ":" . $validatedData['start_time_minutes']);
        $start_time_formatted = date_format($start_time_unformatted,"H:i");

        $validatedData['start_time'] = $start_time_formatted;

        $timestamp_end_time = strtotime($start_time_formatted) + 60*60;
        $end_time_formatted = date('H:i', $timestamp_end_time);

        $validatedData['end_time'] = $end_time_formatted;
        
        $start = strtotime($start_time_formatted) - 30*60;
        $end = strtotime($end_time_formatted) + 30*60;

        if ($this->isWeekend($date_formatted)) {
            $request->session()->flash('error', 'Date is invalid. Please pick a date between Monday - Friday!');  
            return redirect()->back()->withInput($initialValidatedData);
        }

        if (($start_time_unformatted > date_create('12:00') && $start_time_unformatted <date_create('15:30')) || $start_time_unformatted > date_create('20:00')) {
            $request->session()->flash('error', 'Start time is invalid. Please pick a start time between 9:00 - 12:00 or 15:30 - 20:00 !');   
            return redirect()->back()->withInput($initialValidatedData);
        }

        $existingAppointmentCount = Appointment::where('date', '=', $date_formatted)
            ->where('consultant_id', '=', $validatedData['consultant_id'])
            ->where(function($q) use ($start, $end, $start_time_formatted, $end_time_formatted) {
                $q->orWhere(function($q2) use ($start, $end) {
                    $q2->where('start_time', '>=', date('H:i', $start))
                        ->where('start_time', '<', date('H:i', $end));
                })
                ->orWhere(function($q3) use ($start, $end) {
                    $q3->where('end_time', '>', date('H:i', $start))
                        ->where('end_time', '<=', date('H:i', $end));
                })
                ->orWhere(function($q4) use ($start_time_formatted, $end_time_formatted) {
                    $q4->where('start_time', '=', $start_time_formatted)
                        ->where('end_time', '=', $end_time_formatted);
                });
            })
            ->count();

        if ($existingAppointmentCount > 0) {
            $request->session()->flash('error', 'Start time is invalid - appointment already exists for that consultant. Please pick another start time!');   
            return redirect()->back()->withInput($initialValidatedData);
        }

        unset($validatedData['start_time_hour']);
        unset($validatedData['start_time_minutes']);


        $appointment->fill($validatedData);
        $appointment->save();
        $request->session()->flash('success', 'Appointment was updated!');

        return redirect()->route('appointments.index');
    }

    public function destroy(Request $request, $id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        $request->session()->flash('success', 'Appointment was deleted!');

        return redirect()->route('appointments.index');
    } 

    private function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    public function report()
    {
        return view('appointments.report');
    }

    public function report_search(Request $request)
    {
        $input = $request->input();

        $date_unformatted = date_create($input['date']);
        $date_formatted = date_format($date_unformatted,"Y-m-d");

        $appointments = Appointment::where('consultant_id','=', $input['consultant_id'])
                        ->where('date','=', $date_formatted)
                        ->get();

        $consultant = Consultant::find($input['consultant_id']);

        $consultant_full_name = "";
        if ($consultant) {
            $consultant_full_name = $consultant->first_name . " " . $consultant->last_name;
        }

        $input['appointments'] = $appointments;

        return redirect()->back()->with(['appointments' => $appointments, 'consultant' => $consultant_full_name,  'date' => $input['date']]);
    }
}
