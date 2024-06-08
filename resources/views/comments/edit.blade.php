<!-- resources/views/comments/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Comment</h2>
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="3" class="form-control">{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </form>
    </div>
@endsection
