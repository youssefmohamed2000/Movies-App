<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_id', 'title', 'description', 'poster', 'banner', 'type', 'release_date', 'vote', 'vote_count',
    ];

    // ATTRIBUTES

    protected function posterPath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'https://image.tmdb.org/t/p/w500' . $this->poster,
        );
    }

    protected function bannerPath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'https://image.tmdb.org/t/p/w500' . $this->banner,
        );
    }

    // RELATIONS

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favouriteByUser()
    {
        return $this->belongsToMany(User::class, 'user_favourite_movie', 'movie_id');
    }

    // SCOPES

    public function scopeWhenGenreId($query, $genre_id)
    {
        return $query->when($genre_id, function ($q) use ($genre_id) {
            return $q->whereHas('genres', function ($qu) use ($genre_id) {
                return $qu->where('genres.id', $genre_id);
            });
        });
    }

    public function scopeWhenActorId($query, $actor_id)
    {
        return $query->when($actor_id, function ($q) use ($actor_id) {
            return $q->whereHas('actors', function ($qu) use ($actor_id) {
                return $qu->where('actors.id', $actor_id);
            });
        });
    }

    public function scopeWhenType($query, $type)
    {
        return $query->when($type, function ($q) use ($type) {
            if (request()->get('type') == 'popular') {
                return $q->where('type', null);
            }
            return $q->where('type', $type);
        });
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('title', 'LIKE', '%' . $search . '%');
        });
    }

}
