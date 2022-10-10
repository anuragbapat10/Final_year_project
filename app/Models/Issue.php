<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author_id',
        'desc_comment_id',
        'assignee_id',
        'status_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'author_id' => 'int',
        'desc_comment_id' => 'int',
        'assignee_id' => 'int',
        'status_id' => 'int',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'issues_tags')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
