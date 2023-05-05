<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use App\Helpers\Media\MediaHelper;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Comment extends Model implements HasMedia
{
    use HasFactory;
    use HasRecursiveRelationships;
    use InteractsWithMedia;

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issue()
    {
        return $this->hasOne(Issue::class,'desc_comment_id');
    }

    /**
     * @return string
     */
    public static function getCommentAttachmentCollectionName(): string
    {
        return 'comment_attachment';
    }

    /**
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getCommentAttachmentImage(): ?Media
    {
        return $this->getFirstMedia(self::getCommentAttachmentCollectionName());
    }

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        // Register Profile Picture media
        $this->addMediaCollection(self::getCommentAttachmentCollectionName())
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media) {
                MediaHelper::getThumbnailDefinition($this);
            });
    }

}
