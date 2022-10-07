<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'upvote',
        'downvote',
        'parent_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'int',
        'upvote' => 'int',
        'downvote' => 'int',
        'parent_id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTimestamps();
    }
}
