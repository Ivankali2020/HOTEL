<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfirmBookingRequest;
use App\Http\Requests\UpdateConfirmBookingRequest;
use App\Models\ConfirmBooking;
use Illuminate\Http\Request;

class ConfirmBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = ConfirmBooking::when(isset(request()->search),function ($q){
            $code = request()->search;
            return $q->where('name','LIKE',"%$code%")->orWhere('phone','LIKE',"%$code%");
        })->where('checkIn','=','0')->whereDate('date_from','>=',today()->toDateString())->orderBy('id','desc')->simplePaginate(5);
//        return $bookings;
        return view('Backend.Confirm_Booking.index',compact('bookings'));
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
        return $confirmBooking;
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
    public function destroy($id)
    {
        $confirmBooking = ConfirmBooking::findOrFail($id);
        $confirmBooking->delete();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully deleted']);

    }


    public function checkIn(Request $request)
    {
        $book = ConfirmBooking::findOrFail($request->book_id);
        if($book->checkIn == 0){
            $book->checkIn = '1';
            $book->update();

            return redirect()->back()->with('message',['icon'=>'success','text'=>'Your process is ok!']);

        }else{
            $book->checkIn = '2';
            $book->update();

            return view('Backend.Serve.receipt',compact('book'));
        }

    }

    public function serving()
    {

        $servers = ConfirmBooking::when(isset(request()->search),function ($q){
                        $code = request()->search;
                        return $q->where('name','LIKE',"%$code%")->orWhere('phone','LIKE',"%$code%");
                    })
                    ->where('checkIn','=','1')
                    ->whereDate('date_from','>=',today()->toDateString())
                    ->with('getRoom')
                    ->orderBy('id','desc')->simplePaginate(5);
        //return $servers;
        return view('Backend.Serve.index',compact('servers'));
    }
}
