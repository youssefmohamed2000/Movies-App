<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_id', 'name', 'image'
    ];

    // ATTRIBUTES

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'https://image.tmdb.org/t/p/w500' . $this->image,
        );
    }

    // RELATIONS

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actor');
    }

}
