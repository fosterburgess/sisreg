<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstanceRequest;
use App\Http\Requests\UpdateInstanceRequest;
use App\Models\Reg\Instance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class InstanceController extends Controller
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
    public function store(StoreInstanceRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instance $instance): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instance $instance): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstanceRequest $request, Instance $instance): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instance $instance): RedirectResponse
    {
        //
    }
}
