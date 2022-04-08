<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'dead_line',
        'teamleader_id',
    ];

    protected $casts=['dead_line'];


    public function Requirments(){

        return $this->hasMany(Requirment::class);
        
    }

    public function SRSs(){

        return $this->hasMany(Srs::class);
        
    }

    public function TeamLeader(){

        return $this->belongsTo(User::class,'teamleader_id');
        
    }

}
