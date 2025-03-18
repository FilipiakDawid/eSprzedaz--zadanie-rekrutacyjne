@extends('base')

@section('content')
    <div class="container">
        <h1>Add new pet</h1>

        @if($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('pet.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Id:</label>
                <input type="number" class="form-control" placeholder="Pet id" id="id" name="id" min="1" value="{{ old('id')}}" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" placeholder="Pet name" id="name" name="name" value="{{ old('name')}}" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category[name]" name="category[name]"
                       value="{{ old('category.name')}}" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-select" id="status" name="status">
                    @foreach($statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <div class="form-group">
                    <label for="url1">URL 1:</label>
                    <input type="url" name="photo_urls[]" id="url1" class="form-control" required>
                </div>
                <div id="url-fields"></div>

                <button type="button" class="btn btn-secondary mt-2 mb-2" id="add-url">Add URL</button>
            </div>

            <div>
                <div class="form-group">
                    <label for="tag1">URL 1:</label>
                    <input type="number" name="tags[1][id]" id="tag_id1" class="form-control" placeholder="Tag id" min="1" required>
                    <input type="text" name="tags[1][name]" id="tag_name1" class="form-control" placeholder="Tag name" required>
                </div>
                <div id="tag-fields"></div>

                <button type="button" class="btn btn-secondary mt-2 mb-2" id="add-tag">Add Tag</button>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var fieldCount = 1;

            $('#add-url').click(function () {
                fieldCount += 1;
                var newField = `
                <div class="form-group">
                    <label for="url${fieldCount}">URL ${fieldCount}:</label>
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
            var count = 1;

            $('#add-tag').click(function () {
                count += 1;
                var newTagField = `
                <div class="form-group">
                    <label for="tag${count}">Tag ${count}:</label>
                    <input type="number" name="tags[${count}][id]" id="tag_id${count}" class="form-control" min="1" required>
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
