<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room_type(){
        return $this->belongsTo(RoomType::class,'room_type_id');  // ak id ko rkhana ho to hamesa foreign ko rakahte h is table me ho ye us table me (foreign key)
    }

    public function last_booking(){
        return $this->hasOne(BookingRoomList::class, 'room_number_id')->latest();// ak id ko rkhana ho to hamesa foreign ko rakahte h is table me ho ye us table me (foreign key)
    }


}
