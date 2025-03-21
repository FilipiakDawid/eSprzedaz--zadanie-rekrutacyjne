@extends('base')

@section('content')
    <div class="container">
        <h1>Pet name: {{ $pet->getName() }}</h1>

        <div>
            <strong>Category:</strong> {{ $pet->getCategory()->getName() }} <br>
            <strong>Name:</strong> {{ $pet->getName() }} <br>
            <strong>Status:</strong> {{ $pet->getStatus() }} <br>
            <strong>Tags:</strong>
            @foreach ($pet->getTags() as $tag)
                {{ $tag['name'] }}
            @endforeach <br>

            <strong>Photos:</strong>
            @foreach ($pet->getPhotoUrls() as $photo)
                {{ $photo }}
            @endforeach
        </div>

        <br>
        <a href="{{ route('pet.edit', ['id' => $pet->getId()]) }}"  class="btn btn-primary">Edit</a>

        <form onsubmit="return confirm('Are you sure?');" id="delete-form" class="mt-2" method="POST" action="{{ route('pet.delete', ['id' => $pet->getId()]) }}">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <input type="submit" class="btn btn-danger" value="Delete Pet">
            </div>
        </form>
    </div>
@endsection
