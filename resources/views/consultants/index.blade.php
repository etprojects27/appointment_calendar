@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-4"><h3>Consultants</h3></div>

    <table id="consultants-table" class="display">
        <thead>
            <tr>
                <th class="col-1">First Name</th>
                <th class="col-1">Last Name</th>
                <th class="col-1">Phone</th>
                <th class="col-1">Email</th>
                <th class="col-1">Edit</th>
                <th class="col-1">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($consultants as $consultant)
            <tr>
                <td>{{ $consultant->first_name }}</td>
                <td>{{ $consultant->last_name }}</td>
                <td>{{ $consultant->phone }}</td>
                <td>{{ $consultant->email }}</td>
                <td>
                    <a href="{{ route('consultants.edit', ['consultant' => $consultant->id]) }}"
                        class="btn btn-primary">
                        Edit
                    </a>
                </td>
                <td>
                    <form method="POST" class="fm-inline" action="{{ route('consultants.destroy', ['consultant' => $consultant->id]) }}">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Delete!" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6">
                        No consultants yet!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        $(document).ready( function () {
            $('#consultants-table').DataTable();
        } );
    </script>

@endsection('content')