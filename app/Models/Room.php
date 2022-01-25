<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $with = ['features','photos'];


    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
