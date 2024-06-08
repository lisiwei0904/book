<!-- resources/views/books/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Genre:</strong> {{ $book->genre }}</p>
        <p><strong>Description:</strong> {{ $book->description }}</p>

        @auth
            <form action="{{ route('comments.store', $book->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Comment</label>
                    <textarea name="content" id="content" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right; margin-top: 10px">Submit</button>
            </form>

        @else
            <p>Please <a href="{{ route('login') }}">login</a> to comment</p>
        @endauth

        <h2 style="margin-top: 50px">Comments</h2>
        @foreach($book->comments as $comment)
            <p>
                {{ $comment->content }} - <strong>{{ $comment->user->name }}</strong>
                @if(Auth::check() && $comment->user_id === Auth::id())
                    <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            @endif
            </p>
        @endforeach

    </div>
@endsection
