<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
