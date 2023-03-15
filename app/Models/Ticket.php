<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
