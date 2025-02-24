<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCall extends Model
{
    use HasFactory;
    // public $timestamps = false;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
        'status_type',
        'message',
        'type',
    ];
}
