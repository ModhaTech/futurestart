<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Model;

class TalentRiders extends Model
{
   protected $fillable = ['talent_id', 'talent_by', 'user_id', 'rider'];   

   public function rideBy() 
   {
   	   return $this->belongsTo('App\User', 'user_id','id')->withTrashed();
   }

    public function isRider() 
    {
   	   // return $this->belongsTo('App\User', 'user_id','id')->where('id');

   	  if(Auth::check()==true) 
      {
         return $this->belongsTo('App\User', 'user_id','id')->where('id','=', Auth::user()->id);
      } 
      else 
      {
        return $this->belongsTo('App\User', 'user_id','id')->where('id','=', '');
      }
    }
}
