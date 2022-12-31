<?php

namespace App\Helpers\Http\Resources;

/**
 * Class MediaResource
 * @package App\Helpers\Http\Resources
 */
class MediaResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'original_url' => $this->original_url,
            'thumbnail_url' => $this->hasGeneratedConversion('thumb') ? $this->getUrl('thumb') : null,
            'video_url' => $this->video_url,
            'favorite' => (bool)$this->favorite,
        ];
    }
}
