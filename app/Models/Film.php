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
    protected $casts = [
        'status' => FilmStatus::class,
    ];

    protected $withCount = ['comments'];

    protected $fillable = [
        'name',
        'background_image',
        'background_color',
        'description',
        'run_time',
        'released',
        'imdb_id',
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
        $comments =  $this->comments();
        $count = $comments->count();
        $sum = $comments->sum('rating');

        if ($count === 0)
        {
            return $count;
        }

        return round($sum / $count, 1);
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
