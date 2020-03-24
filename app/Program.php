<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    public function slot(){
        $this->belongsTo('App\Slot');
    }
}
