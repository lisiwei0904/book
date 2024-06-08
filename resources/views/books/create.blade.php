@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Book</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" class="form-control" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}"{{ old('genre') == $genre ? ' selected' : '' }}>{{ ucfirst($genre) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group" style="margin-top: 10px">
                <label for="cover_image">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
@endsection
