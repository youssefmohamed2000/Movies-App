<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GetMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get All Movies from TMDB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getPopularMovies();
        $this->getNowPlayingMovies();
        $this->getUpComingMovies();
    }

    private function getPopularMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') . 'movie/popular?region=us&api_key='
                . config('services.tmdb.api_key') . '&page=' . $i);

            foreach ($response->json()['results'] as $result) {

                $movie = Movie::query()->updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],
                    ]
                );
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);
            } // END OF FOREACH

        } // END OF FOR LOOP

    } // END OF FUN

    private function getNowPlayingMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') . 'movie/now_playing?region=us&api_key='
                . config('services.tmdb.api_key') . '&page=' . $i);

            foreach ($response->json()['results'] as $result) {

                $movie = Movie::query()->updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'now_playing',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],
                    ]
                );
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);
            } // END OF FOREACH

        } // END OF FOR LOOP

    } // END OF FUN

    private function getUpComingMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') . 'movie/upcoming?region=us&api_key='
                . config('services.tmdb.api_key') . '&page=' . $i);

            foreach ($response->json()['results'] as $result) {

                $movie = Movie::query()->updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'upcoming',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],
                    ]
                );
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);
            } // END OF FOREACH

        } // END OF FOR LOOP

    } // END OF FUN

    private function attachGenres($result, Movie $movie)
    {
        foreach ($result['genre_ids'] as $genre_id) {
            $genre = Genre::query()->where('e_id', $genre_id)->pluck('id');
            $movie->genres()->syncWithoutDetaching($genre);
        } // END OF FOREACH

    } // END OF FUN

    private function attachActors(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url')
            . 'movie/' . $movie->e_id . '/credits?api_key=' . config('services.tmdb.api_key'));

        foreach ($response->json()['cast'] as $index => $result) {
            if ($result['known_for_department'] != 'Acting') continue;
            if ($index == 12) break;
            $actor = Actor::query()->where('e_id', $result['id'])->first();
            if (!$actor) {
                $actor = Actor::query()->create([
                    'e_id' => $result['id'],
                    'name' => $result['name'],
                    'image' => $result['profile_path'],
                ]);
            }// END OF IF
            $movie->actors()->syncWithoutDetaching($actor->id);
        }// END OF FOREACH

    } // END OF FUN

    private function getImages(Movie $movie)
    {
        $images = Http::get(config('services.tmdb.base_url')
            . 'movie/' . $movie->e_id . '/images?api_key=' . config('services.tmdb.api_key'));
        $movie->images()->delete();
        foreach ($images->json()['backdrops'] as $index => $image) {
            if ($index == 8) break;
            $movie->images()->create([
                'image' => $image['file_path']
            ]);
        } // END OF FOREACH
    } // END OF FUN

}
