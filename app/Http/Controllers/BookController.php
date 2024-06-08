<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create()
    {
        $genres = ['fiction', 'Historical', 'science fiction', 'Adventure', 'Philosophical', 'Others'];
        return view('books.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|in:fiction,Historical,science fiction,Adventure,Philosophical,Others',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverImagePath = null;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'img/cover_images/' . $fileName;
            $file->storeAs('public/img/cover_images', $fileName);
            $coverImagePath = $filePath;
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function index(Request $request)
    {
        $genre = $request->input('genre');
        $books = Book::when($genre, function ($query, $genre) {
            return $query->where('genre', $genre);
        })->paginate(10);

        return view('books.index', compact('books', 'genre'));
    }

    public function show($id)
    {
        $book = Book::with('comments.user')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $book = Book::findOrFail($id);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user()->associate(Auth::user());
        $comment->book()->associate($book);
        $comment->save();

        return redirect()->back()->with('success', 'Comment added!');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        // Check if the authenticated user is authorized to edit this comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        // Check if the authenticated user is authorized to edit this comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('books.show', $comment->book_id)->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        // Check if the authenticated user is authorized to delete this comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

}
