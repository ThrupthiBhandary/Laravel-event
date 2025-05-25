<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

   protected $fillable = ['title', 'description', 'start', 'end', 'user_id', 'attachment', 'category', 'color'];



    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
    

    // 👇 Relationship: Event belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
