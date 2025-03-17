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
                <img src="{{ $photo }}" alt="photo"/>
            @endforeach
        </div>

        <br>
        <a href="" class="btn btn-primary">Edit</a>
    </div>
@endsection
