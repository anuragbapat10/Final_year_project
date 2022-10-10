<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;

class CommentController extends Controller
{
    //
    public function getComment($id): CommentResource {

        return CommentResource::make(Comment::find($id));
    }

    public function getChildComments($id){
        $comments = Comment::tree()->get()->toTree();

        return $comments;
    }

    public function updateComment(CommentRequest $request) {
        if ($request->id !== null) {

            $comment = Comment::find($request->id);
            $comment->update(
                ['user_id' => $request->user_id,
                 'content' => $request->contentt,//contentt used because content is reserved keyword
                 'upvote' => $request->upvote,
                 'downvote' => $request->downvote,]
            );

        } else {
            $comment = Comment::create(
                ['user_id' => $request->user_id,
                    'content' => $request->contentt,//contentt used because content is reserved keyword
                    'upvote' => $request->upvote,
                    'downvote' => $request->downvote,
                    'parent_id' => $request->parent_id],
            );
        }

        return CommentResource::make($comment);
    }

    public function deleteComment($id) {
        $deletedComment = Comment::find($id);
        $deletedComment->delete();

        return CommentResource::make($deletedComment);
    }
}
