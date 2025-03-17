@extends('base')

@section('content')
    <div class="container">
        <h2>Pet List</h2>

        <form method="GET" action="{{ route('index') }}" class="mb-3">
            <label for="filter">Filter by status:</label>
            <select name="status" id="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                @foreach($statuses as $status)
                    <option value="{{ $status }}">
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </form>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet['name'] ?? ''}}</td>
                    <td>{{ $pet['category']['name'] ?? ''}}</td>
                    <td>{{ $pet['status'] }}</td>
                    <td>
                        <a href="{{ route('pet.show', ['id' => $pet['id']]) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
