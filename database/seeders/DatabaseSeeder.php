<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // create categories
        $categories = ['Bad Acting', 'Low Budget Charm', 'So-Bad-It\'s-Good Classics'];
        foreach ($categories as $name) {
            \App\Models\Category::create(['name' => $name]);
        }

        $movies = [
            [
                'title' => 'Shark Tornado',
                'description' => 'A low-budget masterpiece of aquatic mayhem.',
                'release_year' => 2013,
                'poster_url' => 'https://example.com/shark-tornado.jpg',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'Zombie Mall',
                'description' => 'A hilariously bad zombie apocalypse set in a mall.',
                'release_year' => 2017,
                'poster_url' => 'https://example.com/zombie-mall.jpg',
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'Alien Plumbers',
                'description' => 'Two plumbers accidentally summon aliens in their basement.',
                'release_year' => 2020,
                'poster_url' => 'https://example.com/alien-plumbers.jpg',
                'category_id' => 3,
                'user_id' => 1,
            ],
        ];

        foreach ($movies as $movie) {
            \App\Models\Movie::create($movie);
        }

        $reviews = [
            [
                'user_id' => 1,
                'movie_id' => 1,
                'cringe_rating' => 9,
                'content' => 'So bad I couldn’t stop laughing. A masterpiece of chaos!',
            ],
            [
                'user_id' => 1,
                'movie_id' => 2,
                'cringe_rating' => 8,
                'content' => 'The acting is so wooden it deserves an award. Loved it.',
            ],
            [
                'user_id' => 1,
                'movie_id' => 3,
                'cringe_rating' => 7,
                'content' => 'Plot made no sense. Dialogue from another planet. Perfect.',
            ],
        ];

        foreach ($reviews as $review) {
            \App\Models\Review::create($review);
        }

        $watchlists = [
            [
                'user_id' => 1,
                'movie_id' => 1,
                'status' => 'watched',
            ],
            [
                'user_id' => 1,
                'movie_id' => 2,
                'status' => 'to_watch',
            ],
            [
                'user_id' => 1,
                'movie_id' => 3,
                'status' => 'watched',
            ],
        ];

        foreach ($watchlists as $entry) {
            \App\Models\Watchlist::create($entry);
        }
    }
}
