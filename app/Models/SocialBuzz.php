<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB as DB;

class SocialBuzz extends Model
{
    protected $fillable = ['user_id','category_id','comment', 'posted_by', 'product_link','product_img_path','report','active','created_by', 'updated_by'];

    public function getUserData() 
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function getTalentCatagories() 
    {
  		return $this->belongsTo(TalentCatagory::class, 'category_id');
  	}
    public function getSocialBuzzComments() 
    {
        return $this->hasMany('App\Models\SocialBuzzComments','post_id', 'id')->with('commentBy');
    }
    public function getSocialBuzzRiders() 
    {
     return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->with('rideBy');
    }
    public function getSocialBuzzAwards() 
    {
        return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->with('awardBy')->where('award','=', 1);
    } 
    public function getSocialBuzzViewcount() 
    {
      return $this->hasMany('App\Models\SocialBuzzViews','post_id', 'id')->with('viewBy');
    }
    public function alreadyAwarded() 
    {
        if(Auth::check()==true) 
        {
         return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->where('user_id','=', Auth::user()->id);
        }
        else 
        {
         return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->where('user_id','=', '');
        }
    } 
    public function totalPurchase() 
    {
        return $this->hasMany('App\Models\PurchasedProduct','talent_id', 'id');
    } 
    public function selfRider() 
    {
         if(Auth::check() == true) 
         {
           return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->where('user_id','=', Auth::user()->id);
         } 
         else 
         {
             return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->where('user_id','=', '');
         }
    }
    public function getTalent()
    {
        return $this->hasMany('App\Models\Talents','user_id', 'user_id')->where('active','=','Active')->where('approved','=','1')->where('delete_flag','=','0');
    }
    
    // public function getTalent()
    // {
    //     $slug = chop($this->product_link,"https://www.futurestarr.com/api/v1/talent-mall/product-info/");
    //     return Talent::where('slug','=',$slug)->get();
    //     // return $this->hasOne('App\Models\Talent')->where('slug','=',$slug);
    // }
    // public function getTalent()
    // {
    //     return $this->hasMany('App\Models\Talents','user_id', 'user_id')->where('active','=','Active')->where('approved','=','1')->where('delete_flag','=','0');
    // }
    //     public function disapproveTalent()
    // {
    //     return $this->hasMany('App\Models\Talents','user_id', 'user_id')->where('active','=','Active')->where('approved','=','0')->where('delete_flag','=','0');
    // }
}

