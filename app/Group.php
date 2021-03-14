<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    function getUser() {
        return $this->hasOne(User::class,'id','user_id');
    }
    function getItem() {
        return $this->hasOne(Item::class,'id','item_id');
    }
    function getLabel() {
        return $this->hasMany(Label::class,'group_id','id');
    }
    function getGroupLabel() {
        return $this->hasOne(Label::class,'group_id','id');
    }
    function getGroupPhotos() {
        return $this->hasMany(Photo::class,'group_id','id')->where('image_path','!=','empty')->where('image_path','!=','');
    }
}
