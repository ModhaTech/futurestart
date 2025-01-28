<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogContent extends Model
{
	protected $fillable = ['cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'blog_video', 'content','alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status','blog_role', 'date', 'views', 'created_by', 'updated_by', 'created_at', 'updated_at' ];
	protected $casts = [
        'views' => 'integer',
    ];

    public function getBlogCatagories() 
    {
		return $this->belongsTo(TalentCatagory::class, 'cat_id');
	}

	public function getBlogComments() 
	{
		return $this->hasMany(BlogComment::class, 'blog_id', 'id')->where('status', 1);
	}

	public function blogAuthor() 
	{
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

	public function blog_tag() 
	{
		return $this->hasMany(Blog_tag::class, 'blog_id', 'id');
	}
}
