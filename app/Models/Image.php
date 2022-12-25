<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id', 'image'
    ];

    // ATTRIBUTES

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'https://image.tmdb.org/t/p/w500' . $this->image
        );
    }

    // RELATIONS

    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }
}
