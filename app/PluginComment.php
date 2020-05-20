<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PluginComment extends Model
{
    public function user(){
        return $this->belongsTo('App\User'); 

    }

    public function plugin(){
        return $this->belongsTo('App\Plugin'); 

    }
}
