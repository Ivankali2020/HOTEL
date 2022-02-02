<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::when(Auth::user()->role != '1',function ($q){
            return $q->where('user_id',Auth::id());
        })->when(isset(request()->search),function ($q){
            return $q->orWhere('name',request()->search)->orWhere('price',request()->search);
        })->orderBy('id','desc')->simplePaginate(5);
        return view('Backend.Rooms.index',compact('rooms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
//        return $request;
        $request->validate([
            "photos" => "required",
            "photo" => "required|mimes:jpeg,png|max:5000",
            "photos.*" => "file|mimes:jpeg,png|max:5000"
        ]);
        if(!Storage::exists("public/thumbnail")){
            Storage::makeDirectory("public/thumbnail");
        }

        DB::beginTransaction();
        try {
            $file = $request->file('photo');
            $newName = uniqid()."_photo.".$file->extension();
            $file->storeAs('public/photo',$newName);

            $img = Image::make($file);
            $img->fit(200,200);
            $img->save(public_path("/storage/thumbnail/".$newName),60);

            $room = new Room();
            $room->name = $request->name;
            $room->description = $request->description;
            $room->price = $request->price;
            $room->feature_photo = $newName;
            $room->user_id = Auth::user()->id;
            $room->slug = \Illuminate\Support\Str::slug($request->name);
            $room->save();

            $room->features()->attach($request->features);

            foreach ($request->file('photos') as $photo){
                $newName = uniqid()."_photo.".$photo->extension();
//                $photo->storeAs('public/photo',$newName);

                $img = Image::make($photo);
                $img->fit(450,300);
                $img->save(public_path("/storage/photo/".$newName),100);


                $photo = new Photo();
                $photo->name = $newName;
                $photo->room_id = $room->id;
                $photo->user_id = Auth::id();
                $photo->save();
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return $e;
            return redirect()->back()->with('message',['icon'=>'error','text'=>"$e"]);
        }


        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully Inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('Backend.Rooms.show',compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
//        return $room;
        return view('Backend.Rooms.edit',compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {

//        $request->validate([
//            "photo" => "required|mimes:jpeg,png|max:5000",
//        ]);;
        if(!Storage::exists("public/thumbnail")){
            Storage::makeDirectory("public/thumbnail");
        }

        if($request->file('photo') !== null){
            $file = $request->file('photo');
            $newName = uniqid()."_photo.".$file->extension();
            $file->storeAs('public/photo',$newName);

            $img = Image::make($file);
            $img->fit(200,200);
            $img->save(public_path("/storage/thumbnail/".$newName),60);
            $room->feature_photo = $newName;

        }

        $room->name = $request->name;

        $room->description = $request->description;
        $room->price = $request->price;
        $room->user_id = Auth::user()->id;
        $room->slug = \Illuminate\Support\Str::slug($request->name);
        $room->update();

        $room->features()->detach();
        $room->features()->attach($request->features);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->features()->detach();
        foreach ($room->photos as $p){
            Storage::delete('public/photo/'.$p->name);
            Storage::delete('public/thumbnail/'.$p->name);
        }
        $room->delete();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully deleted']);

    }
}
