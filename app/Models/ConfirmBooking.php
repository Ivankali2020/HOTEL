<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmBooking extends Model
{
    use HasFactory;

    protected $with=['getRoom'];

    public function getRoom()
    {
        return $this->belongsTo(Room::class,'room_id','id')->withOnly('photos');
    }
}
