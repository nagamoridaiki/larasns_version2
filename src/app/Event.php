<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'detail',
        'image',
        'address',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function join(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'join_user')->withTimestamps();
    }

    public function isJoinedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->join->where('id', $user->id)->count()
            : false;
    }

    public function getCountJoinAttribute(): int
    {
        return $this->join->count();
    }


}
