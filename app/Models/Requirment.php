<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirment extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'project_id',
    ];

    public function Project(){

        return $this->belongsTo(Project::class);
        
    }

    public function Tasks(){

        return $this->hasMany(Task::class);
        
    }
}
