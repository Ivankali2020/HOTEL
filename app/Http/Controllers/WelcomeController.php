<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('id','desc')->get();
        return view('welcome',compact('rooms'));
    }
}
