<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestreamComment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =
    [
    	'stream_id',
    	'comment_id',
    	'comment'
    ];
}
