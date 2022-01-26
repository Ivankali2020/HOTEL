<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $rooms = Room::when(isset($request->date),function ($q){
            return $q->whereDate('created_at','=',request()->date);
        })->get();
        return view('Backend.home',compact('rooms'));
    }
}
