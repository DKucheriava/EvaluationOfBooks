<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;

class BookController extends Controller
{
    public function getBooks(Request $request)
    {
        $books = Book::limit(10)->get();

        return view('books_list', ['books' => $books]);
    }

    public function bookInfo($id)
    {
        $book = Book::findOrFail($id);
        $rating = round(Comment::where('book_id', $id)->avg('rating'), 2);

        $books = Book::inRandomOrder()->limit(5)->get();

        return view('book_info', ['rating' => $rating, 'book' => $book, 'books' => $books]);
    }

    public function searchBook(Request $request)
    {
        $keyWord = $request->keyWord;
        $findBooks = [];

        if (isset($keyWord)) {
            $findBooks = Book::where('author', 'Like', '%' . $keyWord . '%')->orWhere('title', 'Like', '%' . $keyWord . '%')->get();
        }

        return view('books_list', ['books' => $findBooks]);
    }

    public function sortBooks(Request $request)
    {
        $sortOption = $request->sortOption;

        $query = Book::query();

        if ($sortOption === 'asc') {
            $query->orderBy('title', 'asc');
        } elseif ($sortOption === 'desc') {
            $query->orderBy('title', 'desc');
        }

        $sortBooks = $query->limit(10)->get();

        return view('books_list', ['books' => $sortBooks]);
    }

    public function addNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:9999',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $searchBook = Book::where('title', $request->title)->first();
        if ($searchBook) {
            return response()->json(['message' => 'A book with the same title already exists'], 409);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publication_year' => $request->year,
            'genre' => $request->genre,
            'description' => $request->description,
            'cover_image' => $imagePath,
        ]);

        return response()->json(['message' => 'Book added successfully!'], 200);
    }

    public function refreshBookList($limit)
    {
        $books = Book::inRandomOrder()->limit($limit)->get();

        return  response()->json(['books' => $books]);
    }
}
