<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'user_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
