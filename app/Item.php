<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    function getUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
 
    function ItemGroups() {
        return $this->hasMany(Group::class, 'item_id', 'id');
    }
    function ItemPhotos() {
        return $this->hasMany(Photo::class, 'item_id', 'id')->where('group_id',null)->where('type','!=','2');
    }
    function ItemAllPhotos() {
        return $this->hasMany(Photo::class, 'item_id', 'id')->where('image_path','!=','');
    } 
    function ItemSinglePhotos() {
        return $this->hasMany(Photo::class, 'item_id', 'id')->where('type','0');
    } 
    function multiLabelPhotos() {
        return $this->hasMany(Photo::class, 'item_id', 'id')->where('type','1');
    } 
}
