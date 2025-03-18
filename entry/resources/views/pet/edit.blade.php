@extends('base')

@section('content')
    <div class="container">
        <h1>Edit pet: {{ $pet->getName() }}</h1>

        @if($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('pet.update', $pet->getId()) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $pet->getName()) }}">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category[name]" name="category[name]"
                       value="{{ old('category_name', $pet->getCategory()->getName()) }}">
                <input type="hidden" name="category[id]" value="{{ old('category_id', $pet->getCategory()->getId()) }}">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    @foreach($statuses as $key => $status)
                        <option
                            value="{{ $key }}" {{ $pet->getStatus() == $key ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div id="url-fields">
                @foreach($pet->getPhotoUrls() as $key => $url)
                    <div class="form-group">
                        <label for="url1">URL:</label>
                        <input type="url" name="photo_urls[]" id="url{{$key}}" class="form-control" value="{{$url}}"
                               required>
                        @if($key > 0)
                            <button type="button" class="btn btn-danger btn-sm remove-url">Remove</button>
                        @endif
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mt-2 mb-2" id="add-url">Add URL</button>

            <div id="tag-fields">
                @foreach($pet->getTags() as $key => $tag)
                    <div class="form-group">
                        <label for="tag{{$key}}">Tag</label>
                        <input type="number" name="tags[{{$key}}][id]" id="tag_id{{$key}}" class="form-control" placeholder="Tag id" value="{{$tag['id']}}" required>
                        <input type="text" name="tags[{{$key}}][name]" id="tag_name{{$key}}" class="form-control" placeholder="Tag name" value="{{$tag['name']}}" required>
                        @if($key > 0)
                            <button type="button" class="btn btn-danger btn-sm remove-tag">Remove</button>
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary mt-2 mb-2" id="add-tag">Add Tag</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <div class="mt-4">
            <form action="{{ route('pet.uploadImage', ['id' => $pet->getId()]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Select image</label>
                    <input type="file" class="form-control" id="image" name="image"
                           accept="image/jpeg, image/jpg, image/png" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var fieldCount = {{count($pet->getPhotoUrls())}};
            $('#add-url').click(function () {
                fieldCount += 1;
                var newField = `
                <div class="form-group">
                    <label for="url${fieldCount}">URL</label>
                    <input type="url" name="photo_urls[]" id="url${fieldCount}" class="form-control" required>
                    <button type="button" class="btn btn-danger btn-sm remove-url">Remove</button>
                </div>
            `;
                $('#url-fields').append(newField);

                $('.remove-url').show();
            });

            $(document).on('click', '.remove-url', function () {
                $(this).closest('.form-group').remove();
                fieldCount -= 1;
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var count = {{$pet->getTags()->count()}};

            $('#add-tag').click(function () {
                count += 1;
                var newTagField = `
                <div class="form-group">
                    <label for="tag${count}">Tag:</label>
                    <input type="number" name="tags[${count}][id]" id="tag_id${count}" class="form-control" required>
                    <input type="text" name="tags[${count}][name]" id="tag_name${count}" class="form-control" required>
                    <button type="button" class="btn btn-danger btn-sm remove-tag">Remove</button>
                </div>
            `;
                $('#tag-fields').append(newTagField);

                $('.remove-tag').show();
            });

            $(document).on('click', '.remove-tag', function () {
                $(this).closest('.form-group').remove();
                count -= 1;
            });
        });
    </script>
@endsection
