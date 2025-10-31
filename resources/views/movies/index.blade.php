@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">🎬 So Bad It’s Good Movies</h1>

    @if($movies->count())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($movies as $movie)
        <div class="bg-white shadow rounded-2xl p-4">
            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="rounded-xl mb-3 w-full h-64 object-cover">
            <h2 class="text-xl font-semibold">{{ $movie->title }}</h2>
            <p class="text-gray-500 text-sm mb-2">{{ $movie->release_year }} • {{ $movie->category->name ?? 'No category' }}</p>
            <p class="text-gray-700 text-sm mb-2">
                Average Cringe:
                <strong>
                    {{ number_format($movie->reviews->avg('cringe_rating'), 1) ?? 'N/A' }}
                </strong>
            </p>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center text-gray-500">No movies found. Try seeding the database again.</p>
    @endif
</div>
@endsection