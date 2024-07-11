<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'content' => $request->comment,
            'rating' => $request->rating
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
