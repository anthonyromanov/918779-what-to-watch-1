<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Enums\FilmStatus;

class Film extends Model
{
    use HasFactory;

    /**
     * Default film status.
     *
     * @var array
     */
    protected $attributes = [
        'status' => FilmStatus::class,
    ];

    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function image(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Director::class);
    }

    public function stars(): BelongsToMany
    {
        return $this->belongsToMany(Star::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getRating(): float
    {
        $count = $this->comments()->count();
        $sum = $this->comments()->sum('rating');

        return $sum / $count;
    }

    public function isModerate(): bool
    {
        return $this->status === FilmStatus::MODERATE;
    }

    public function isReady(): bool
    {
        return $this->status === FilmStatus::READY;
    }
}
