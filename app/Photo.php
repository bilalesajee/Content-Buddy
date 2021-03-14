<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    function getLabel() {
        return $this->hasMany(Label::class, 'photo_id', 'id');
    }
    function getSingleLabel() {
        return $this->hasOne(Label::class, 'photo_id', 'id');
    }
    function getOneLabel() {
        return $this->hasOne(Label::class, 'group_id','group_id');
    }
    function getItems() {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
    function getGroup() {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

}
