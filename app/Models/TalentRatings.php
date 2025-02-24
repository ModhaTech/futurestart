<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentRatings extends Model
{
    protected $fillable = ['user_id','talent_id','rating','buyer_comment','created_by','updated_by'];

     public function commentratingBy() {
   	   return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
    }
}
