<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
    // Un vote appartient à un feedback
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
