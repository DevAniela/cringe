<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['category', 'reviews'])->get();

        return view('movies.index', compact('movies'));
    }
}
