<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimePeriodRequest;
use App\Http\Requests\UpdateTimePeriodRequest;
use App\Models\Reg\TimePeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TimePeriodController extends Controller
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
    public function store(StoreTimePeriodRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TimePeriod $timePeriod): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimePeriod $timePeriod): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimePeriodRequest $request, TimePeriod $timePeriod): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimePeriod $timePeriod): RedirectResponse
    {
        //
    }
}
