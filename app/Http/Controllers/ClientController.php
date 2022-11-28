<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\StoreClient;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', ['clients' => Client::all()]);
    }

    public function show($id)
    {
        return view('clients.show', ['client' => Client::findOrFail($id)]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClient $request)
    {
        $validatedData = $request->validated();
        $client = Client::create($validatedData);
        $request->session()->flash('success', 'Client was created!');
        
        return redirect()->route('clients.index');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', ['client' => $client]);
    }

    public function update(StoreClient $request, $id)
    {
        $client = Client::findOrFail($id);
        $validatedData = $request->validated();

        $client->fill($validatedData);
        $client->save();
        $request->session()->flash('success', 'Client was updated!');

        return redirect()->route('clients.index');
    }

    public function destroy(Request $request, $id) {
        $client = Client::findOrFail($id);

        if ($client->appointments->count()) {
            $request->session()->flash('error', "Client wasn't deleted - he has appointments!");
        } else {
            $client->delete();
            $request->session()->flash('success', 'Client was deleted!');
        }

        return redirect()->route('clients.index');
    }
}
