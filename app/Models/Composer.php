<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'composer_movie');
    }
}
