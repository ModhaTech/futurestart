<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SocialBuzzViews extends Model
{
  protected $fillable = ['post_id','user_id','views'];
    
  public function viewBy() 
  {
	return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
  }
}