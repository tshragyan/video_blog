<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Post
 * @package App\Models
 *
 * @property int id
 * @property int user_id
 * @property string title
 * @property string body
 */
class Post extends Model
{
    protected $fillable = ['title', 'user_id', 'body'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function isOwner(int $user_id): bool
    {
        return $this->user_id === $user_id;
    }
}
