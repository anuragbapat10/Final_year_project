<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    /**
     * @param \App\Http\Requests\TagRequest $request
     *
     * @return \App\Http\Resources\TagResource
     */
    public function getTag($id): TagResource {

        return TagResource::make(Tag::find($id));
    }

    public function getAllTags(){

        return TagResource::collection(Tag::all());
    }

    public function updateTag(TagRequest $request): TagResource {

        if ($request->id !== null) {

            $tag = Tag::find($request->id);
            $tag->update(
                ['name' => $request->name]
            );
        } else {
            $tag = Tag::create([
                'name' => $request->name,
            ]);
        }

        return TagResource::make($tag);
    }

    public function deleteTag($id): TagResource {

        $deletedTag = Tag::find($id);
        $deletedTag->delete();

        return TagResource::make($deletedTag);
    }
}
