<?php

namespace App\Http\Resources;

use App\Helpers\Http\Resources\BaseResource;
use App\Helpers\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'content' => $this->content,
            'upvote' => $this->upvote,
            'downvote' => $this->downvote,
            'updated_at' => $this->updated_at,
            'profile_picture' => !empty($this->getCommentAttachmentImage()) ? MediaResource::make($this->getCommentAttachmentImage()) : null,
        ];
    }
}
