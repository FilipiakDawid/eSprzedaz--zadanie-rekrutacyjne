@extends('base')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="primary-header">
            @if(isset($message))
                {{ "Error " . $code . ":" }}
                {{ $message }}
            @else
                {{ "Bad request" }}
            @endif
        </h1>

        <div class="mt-4">
            <a href="{{ route('index') }}" class="btn btn-primary">🏠 Home</a>
        </div>
    </div>
@endsection
