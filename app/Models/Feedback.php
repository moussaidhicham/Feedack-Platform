<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Spécifier explicitement le nom de la table
    protected $table = 'feedbacks'; 

    public function course()
{
    return $this->belongsTo(Course::class);
}

    public function user()
{
    return $this->belongsTo(User::class);
}

public function votes()
{
    return $this->hasMany(Vote::class);
}

public function getLikesAttribute()
{
    return $this->votes()->where('type', 'like')->count();
}

public function getDislikesAttribute()
{
    return $this->votes()->where('type', 'dislike')->count();
}

    
    
}
