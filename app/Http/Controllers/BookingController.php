<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::when(isset(request()->search),function ($q){
            $code = request()->search;
            return $q->where('name','LIKE',"%$code%")->orWhere('phone','LIKE',"%$code%");
        })->orderBy('id','desc');
        if(Auth::check()){
            $bookings = $bookings->simplePaginate(5);
            return view('Backend.Boooking.index',compact('bookings'));
        }else{
            $bookings = $bookings->where('id',Auth::id())->get();
            return view('booking',compact('bookings'));
        }
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
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//StoreBookingRequest
    {
        $data = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'room_id' => 'required|min:1'
        ]);


        if ($data->fails()) {
            return redirect()->back()->with('message',['icon'=>'error','text'=>'you should put all field']);
        }

        $validated = $data->validated();
        DB::table('bookings')->insert($validated);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Thanks! we will contact soon']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully Deleted']);

    }


    public function confirm(Request $request)
    {
        if(!isset($request->booking_confirm)){
            return redirect()->back()->with('message',['icon'=>'success','text'=>'Something was wrong!']);
        }
        $book = Booking::find($request->book_id)->only(['name','email','phone','date_from','date_to','room_id']);
        Booking::find($request->book_id)->delete();
        DB::table('confirm_bookings')->insert($book);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Confirm Successfully']);
    }
}
