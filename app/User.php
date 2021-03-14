<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    function userItems() {
        return $this->hasMany(Item::class, 'user_id', 'id');
    }
    function userGroups() {
        return $this->hasMany(Group::class, 'user_id', 'id');
    }
    function userPhotos() {
        return $this->hasMany(Photo::class, 'user_id', 'id');
    } 
}
