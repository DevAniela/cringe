<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['category', 'reviews'])->get();

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title',
            'release_year' => 'required|integer|min:1900|max: ' . date('Y'),
            'poster_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);

        Movie::create([
            'title' => $validated['title'],
            'release_year' => $validated['release_year'],
            'poster_url' => $validated['poster_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'user_id' => Auth::id(),
        ]);           
            
            return redirect()->route('movies.index')->with('success', 'Movie added!');
    }

    public function edit(Movie $movie) {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('movies', 'title')->ignore($movie),
            ],
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'poster_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);
        $movie->update($validated);
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }
    public function destroy(Movie $movie)
    {
        if($movie->user_id !== Auth::id())
        {
            abort(403, 'Unauthorized action.');
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
