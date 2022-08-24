<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function film(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);
    }
}
