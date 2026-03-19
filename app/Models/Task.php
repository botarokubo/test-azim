<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Task extends Model
{
    
    protected $fillable = [
        'user_id',
        'title',
        'is_completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
