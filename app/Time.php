<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    //
    protected $fillable=['starts', 'ends', 'program_id'];
    public function slot(){
        return $this->belongsTo('App\Slot');
    }
}
