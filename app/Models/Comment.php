<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Post
 * @package App\Models
 *
 * @property int id
 * @property int commentable_id
 * @property string comment
 * @property string commentable_type
 */
class Comment extends Model
{
    protected $fillable = ['commentable_id', 'comment', 'commentable_type'];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
