<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tagline', 'year', 'budget', 'duration'];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }

    public function composers()
    {
        return $this->belongsToMany(Composer::class, 'composer_movie');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    public static function scopeWithAllRelations($query)
    {
        return $query->with('actors', 'directors', 'composers', 'countries');
    }
}
