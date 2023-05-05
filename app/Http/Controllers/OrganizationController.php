<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Resources\UserResource;
use App\Http\Resources\IssueResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\IssuesSummaryResource;

class OrganizationController extends Controller
{
    //
    public function getOrganization($id): OrganizationResource {

        return OrganizationResource::make(Organization::find($id));
    }

    public function updateOrganization(OrganizationRequest $request) {
        
        if ($request->id !== null) {
            if ($request->password !== NULL) {
                $organization = Organization::find($request->id);
                $organization->update(
                    ['id' => $request->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'hashed_password' => hash('sha256', $request->password),
                    'description' => $request->description,]
                );
            } else {
                $organization = Organization::find($request->id);
                $organization->update(
                    ['id' => $request->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'description' => $request->description,]
                );
            }

        } else {
            $organization = Organization::create([
                'name' => $request->name,
                'email' => $request->email,
                'hashed_password' => hash('sha256', $request->password),
                'description' => $request->description,]
            );
        }

        return OrganizationResource::make($organization);
    }

    public function deleteOrganization($id) {
        $deletedOrganization = Organization::find($id);
        $deletedOrganization->delete();

        return OrganizationResource::make($deletedOrganization);
    }

    public function getOrganizationEmployees($id) {
        return EmployeeResource::collection(Organization::find($id)->users);
    }

    public function getOrganizationIssues($id) {
        return IssueResource::collection(Organization::find($id)->issues);
    }
}
