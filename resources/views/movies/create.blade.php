<form method="POST" action="{{ route('movies.store') }}">
@csrf

<div>
    <label for="title" class="block text-sm font-medium text-gray-700">Movie Title *</label>
    <input type="text" name="title" id="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('title') }}">

    @error('title')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<button type="submit">Add Movie</button>
</form>
