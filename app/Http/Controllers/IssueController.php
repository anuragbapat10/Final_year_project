<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Http\Requests\IssueRequest;
use App\Http\Resources\IssueResource;
use App\Http\Resources\IssuesSummaryResource;
use App\Models\User;

class IssueController extends Controller
{
    /**
     * @param \App\Http\Requests\IssueRequest $request
     *
     * @return \App\Http\Resources\IssueResource
     */
    public function getIssue($id): IssueResource {

        return IssueResource::make(Issue::find($id));
    }

    public function getAllIssues(){

        return IssuesSummaryResource::collection(Issue::all());
    }

    public function updateIssue(IssueRequest $request){
        //TODO: HANDLE TAG IDS

        if ($request->id !== null) {

            Issue::find($request->id)->update(
                ['title' => $request->title,
                'organization_id' => $request->organization_id,
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
                'organization_id' => $request->organization_id,
                'author_id' => $request->author_id,
                'desc_comment_id' => $request->desc_comment_id,
                'assignee_id' => $request->assignee_id,
                'status_id' => 1],
            );
            $issue->tags()->attach($request->tags);
        }



        return IssueResource::make($issue);
    }

    public function deleteIssue($id): IssueResource {

        $deletedIssue = Issue::find($id);
        $deletedIssue->delete();

        return IssueResource::make($deletedIssue);
    }

    public function getFilteredIssue(IssueRequest $request){

        return IssueResource::collection();
    }
}
