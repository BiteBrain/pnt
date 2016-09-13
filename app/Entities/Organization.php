<?php

namespace Theater\Entities;

use Illuminate\Database\Eloquent\Model;
use Theater\User;

class Organization extends Model
{
    protected $fillable = ['name', 'email', 'city', 'address', 'phone', 'mobile', 'website'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    public function propietor(){
        return $this->hasOne(Propietor::class);
    }

    public function awards(){
        return $this->belongsToMany(Award::class);
    }
}
