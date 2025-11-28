@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">🎬 So Bad It’s Good Movies</h1>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if($movies->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($movies as $movie)
        <div class="bg-white shadow rounded-2xl p-4">

            <h2 class="text-xl font-semibold">{{ $movie->title }}</h2>

            @auth
                @if($movie->user_id == Auth::id())
                <div class="mt-3 flex justify-end space-x-2">
                    <a href="{{ route('movies.edit', $movie) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-2 py-1 rounded">
                       Edit
                    </a>

                <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-2 py-1 rounded" onclick="return confirm('Are you sure you want to delete the movie {{ $movie->title }}?');">
                        Delete
                    </button>
                </form>
            </div>
            @endif
            @endauth
            
            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="rounded-xl mb-3 w-full h-64 object-cover">
            <p class="text-gray-500 text-sm mb-2">{{ $movie->release_year }} • {{ $movie->category->name ?? 'No category' }}</p>
            <p class="text-gray-700 text-sm mb-2">
                Average Cringe:
                <strong>
                    {{ number_format($movie->reviews->avg('cringe_rating'), 1) ?? 'N/A' }}
                </strong>
            </p>

            @if($movie->reviews->count())
            <div class="mt-2 border-t pt-2">
                @foreach($movie->reviews as $review)
                    <p class="text-sm"><strong>{{ $review->user->name }}:</strong> {{ $review->content }} (Rating: {{ $review->cringe_rating }}) </p>
                @endforeach
            </div>
            @endif

            @auth
                <form action="{{ route('reviews.store', $movie) }}" method="POST" class="mt-4 border-t pt-3">
                    @csrf
                    <div>
                        <label for="cringe_rating_{{ $movie->id }}" class="block text-sm font-medium">Cringe Rating (1-10)</label>
                        <input type="number" name="cringe_rating" id="cringe_rating_{{ $movie->id }}" min="1" max="10" required class="border rounded p-1 w-20 mt-1">
                    </div>
                    
                    <div class="mt-2">
                        <label for="content_{{ $movie->id }}" class="block text-sm font-medium">Your Review</label>
                        <textarea name="content" id="content_{{ $movie->id }}" rows="3" required class="border rounded w-full p-2 mt-1"></textarea>
                    </div>

                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Submit Review</button>
                </form>
            @endauth
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center text-gray-500">No movies found. Try seeding the database again.</p>
    @endif
</div>
@endsection