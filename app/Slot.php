<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    public function assignment(){
        return $this->belongsTo('App\Assignment');
    }
    public function times(){
        return $this->hasMany('App\Time');
    }
    public function programs(){
        return $this->hasMany('App\Program');
    }
}
