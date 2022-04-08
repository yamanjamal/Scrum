<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'comment_id',
        'task_id',
    ];

    public function Task(){

        return $this->belongsTo(Task::class);
        
    }

    public function User(){

        return $this->belongsTo(User::class);
        
    }

    public function Comments(){

        return $this->hasMany(Comment::class);
        
    }
}
