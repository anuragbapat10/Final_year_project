<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;

class OrganizationController extends Controller
{
    //
    public function getOrganization($id): OrganizationResource {

        return OrganizationResource::make(Organization::find($id));
    }

    public function updateOrganization(OrganizationRequest $request) {
        if ($request->id !== null) {

            $organization = Organization::find($request->id);
            $organization->update(
                ['id' => $request->id,
                 'name' => $request->name,
                 'email' => $request->email,
                 'hashed_password' => $request->hashed_password,
                 'description' => $request->description,]
            );

        } else {
            $organization = Organization::create([
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'hashed_password' => $request->hashed_password,
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
}
