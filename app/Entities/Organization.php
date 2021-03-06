<?php

namespace Theater\Entities;

use Illuminate\Database\Eloquent\Model;
use Theater\User;

class Organization extends Model
{
    protected $fillable = ['name', 'email', 'address', 'phone', 'mobile', 'website', 'socials', 'city_id'];

    public function award(){
        return $this->hasOne(Award::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
