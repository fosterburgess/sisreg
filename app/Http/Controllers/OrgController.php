<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrgRequest;
use App\Http\Requests\UpdateOrgRequest;
use App\Models\Reg\Org;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrgRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Org $org): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Org $org): Response
    {
        //
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
