<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class);
    }


    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
