<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'requirment_id',
        'developer_id',
    ];

    public function Requirment(){

        return $this->belongsTo(Requirment::class);
        
    }

    public function Comments(){

        return $this->hasMany(Comment::class);
        
    }

    
    public function Developer(){

        return $this->belongsTo(User::class);
        
    }
}
