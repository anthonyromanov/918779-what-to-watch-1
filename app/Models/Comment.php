<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault([
            'name' => 'Anonymous',
        ]);
    }

    public function userName()
    {
        $userName = $this->user()->name();

        if ($userName === null) {
            return 'Anonymous';
        }

        return $userName;
    }
}
