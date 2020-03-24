<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    public function slot(){
        return $this->hasOne('App\Slot');
    }
}
