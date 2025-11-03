<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'cringe_rating' => 'required|integer|min:1|max:10',
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'cringe_rating' => $validated['cringe_rating'],
            'content' => $validated['content'],
        ]);
        return redirect()->route('movies.index')->with('success', 'Review added!');
    }
}
