<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrgRequest;
use App\Http\Requests\UpdateOrgRequest;
use App\Models\Constants;
use App\Models\Reg\Org;
use App\Policies\OrgPolicy;
use App\Services\OrgService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $orgs = Org::all();
        $user = $request->user();
        $canCreateTopLevel = $user->hasPermissionTo(Constants::PERM_CREATE_TOP_ORG);

        return response()->view('org.index', compact('orgs', 'canCreateTopLevel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Org $parent = null): Response
    {
        $orgTypes = Org::ORG_LEVELS;
        if ($parent!==null) {
            $orgTypes = [Org::ORG_LEVEL_TYPE_STATE];
            $this->authorize('createTopLevel', [Org::class, $request]);
        }

        $orgTypes = collect($orgTypes)->map(function($k) {
            return ['label'=>$k, 'value'=>$k];
        })->toArray();
        return response()->view('org.create', compact('orgTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrgRequest $request, OrgService $orgService): RedirectResponse
    {
        $this->authorize('create', [Org::class, $request]);
        $org = $orgService->createOrg($request->validated());

        return redirect()->to(route('org.show', ['org'=>$org]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Org $org): Response
    {
        $this->authorize('view', $org);

        return response()->view('org.show', compact('org'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Org $org): Response
    {
        $orgTypes = Org::ORG_LEVELS;
        if ($org->parent!==null) {
            $orgTypes = [Org::ORG_LEVEL_TYPE_STATE];
            $this->authorize('createTopLevel', [Org::class, $request]);
        }
        $orgTypes = collect($orgTypes)->map(function($k) {
            return ['label'=>$k, 'value'=>$k];
        })->toArray();
        return response()->view('org.edit', compact('org', 'orgTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrgRequest $request, Org $org): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Org $org): RedirectResponse
    {
        //
    }
}
