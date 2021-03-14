<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    function getRoom() {
        return $this->hasOne(Room::class,'id','room_id');
    }
    function getUser() {
        return $this->hasOne(User::class,'id','user_id');
    }
    function getGroup() {
        return $this->hasOne(Group::class,'id','group_id');
    }
}
