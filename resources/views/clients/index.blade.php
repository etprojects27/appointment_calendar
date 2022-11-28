@extends('layouts.app')

@section('content')
 <div class="d-flex justify-content-center mt-4"><h3>Clients</h3></div>

    <table id="clients-table" class="display">
        <thead>
            <tr>
                <th class="col-1">First name</th>
                <th class="col-1">Last Name</th>
                <th class="col-1">Country</th></th>
                <th class="col-1">State</th>
                <th class="col-1">City</th>
                <th class="col-1">Phone</th>
                <th class="col-1">Email</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
            <tr>
                <td>{{ $client->first_name }}</td>
                <td>{{ $client->last_name }}</td>
                <td>{{ $client->country }}</td>
                <td>{{ $client->state }}</td>
                <td>{{ $client->city }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="{{ route('clients.edit', ['client' => $client->id]) }}"
                        class="btn btn-primary">
                        Edit
                    </a>
                </td>
                <td>
                    <form method="POST" class="fm-inline" action="{{ route('clients.destroy', ['client' => $client->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete!" class="btn btn-danger"/>
                  </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9">
                        No clients yet!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <script>
        $(document).ready( function () {
            $('#clients-table').DataTable();
        } );
    </script>
@endsection('content')