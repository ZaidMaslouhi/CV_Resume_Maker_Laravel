<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{

    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function experience(){
        return $this->hasMany('App\Experience');
    }

    public function formation(){
        return $this->hasMany('App\Formation');
    }

    public function competence(){
        return $this->hasMany('App\Competence');
    }

}
