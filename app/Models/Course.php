<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Un cours a plusieurs feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    protected $fillable = [
        'title', 
        'description', 
        'instructor', 
        'category', 
        'thumbnail',
        'pdf'
    ];
}

