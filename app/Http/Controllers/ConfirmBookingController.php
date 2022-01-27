<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfirmBookingRequest;
use App\Http\Requests\UpdateConfirmBookingRequest;
use App\Models\ConfirmBooking;

class ConfirmBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConfirmBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfirmBookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConfirmBooking  $confirmBooking
     * @return \Illuminate\Http\Response
     */
    public function show(ConfirmBooking $confirmBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConfirmBooking  $confirmBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfirmBooking $confirmBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConfirmBookingRequest  $request
     * @param  \App\Models\ConfirmBooking  $confirmBooking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfirmBookingRequest $request, ConfirmBooking $confirmBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConfirmBooking  $confirmBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfirmBooking $confirmBooking)
    {
        //
    }
}
