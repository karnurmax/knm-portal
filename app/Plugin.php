<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function categories(){
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }


    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }  
    
    public function plugin_comments(){
    	return $this->hasMany('App\PluginComment');
    }  

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }






}
