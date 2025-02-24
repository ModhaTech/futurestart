<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_category';

    protected $fillable = ['name'];

    
}
