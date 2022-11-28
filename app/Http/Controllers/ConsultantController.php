<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;
use App\Http\Requests\StoreConsultant;
use App\Models\Appointment;

class ConsultantController extends Controller
{
    public function index()
    {
        return view('consultants.index', ['consultants' => Consultant::all()]);
    }

    public function show($id)
    {
        return view('consultants.show', ['consultant' => Consultant::findOrFail($id)]);
    }

    public function create()
    {
        return view('consultants.create');
    }

    public function store(StoreConsultant $request)
    {
        $validatedData = $request->validated();
        $consultant = Consultant::create($validatedData);
        $request->session()->flash('success', 'Consultant was created!');
        
        return redirect()->route('consultants.index');
    }

    public function edit($id)
    {
        $consultant = Consultant::findOrFail($id);
        return view('consultants.edit', ['consultant' => $consultant]);
    }

    public function update(StoreConsultant $request, $id)
    {
        $consultant = Consultant::findOrFail($id);
        $validatedData = $request->validated();

        $consultant->fill($validatedData);
        $consultant->save();
        $request->session()->flash('success', 'Consultant was updated!');

        return redirect()->route('consultants.index');
    }

    public function destroy(Request $request, $id) {
        $consultant = Consultant::findOrFail($id);

        if ($consultant->appointments->count()) {
            $request->session()->flash('error', "Consultant wasn't deleted - he has appointments!");
        } else {
            $consultant->delete();
            $request->session()->flash('success', 'Consultant was deleted!');
        }

        return redirect()->route('consultants.index');
    }
}
