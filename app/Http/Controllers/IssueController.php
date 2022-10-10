<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Http\Requests\IssueRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\IssueResource;

class IssueController extends Controller
{
    /**
     * @param \App\Http\Requests\IssueRequest $request
     *
     * @return \App\Http\Resourcees\IssueResource
     */
    public function getIssue($id): IssueResource {

        return IssueResource::make(Issue::find($id));
    }

    public function updateIssue(IssueRequest $request): IssueResource {
        //TODO: HANDLE TAG IDS

        if ($request->id !== null) {

            Issue::find($request->id)->update(
                ['title' => $request->title,
                'author_id' => $request->author_id,
                'desc_comment_id' => $request->desc_comment_id,
                'assignee_id' => $request->assignee_id,
                'status_id' => $request->status_id],
            );
            $issue = Issue::where('id', $request->id)->first();
            $issue->tags()->detach();
            $issue->tags()->attach($request->tags);
        } else {
            $issue = Issue::create(
                ['title' => $request->title,
                'author_id' => $request->author_id,
                'desc_comment_id' => $request->desc_comment_id,
                'assignee_id' => $request->assignee_id,
                'status_id' => $request->status_id],
            );
            $issue = Issue::where('', $request->desc_comment_id)->first();
            $issue->tags()->attach($request->tags);
        }

        

        return IssueResource::make($issue);
    }
}
