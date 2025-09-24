<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'tags',
        'views',
        'best_answer_id',
        'is_anonymous',
    ];

    /* ==========================
     |   RELATIONSHIPS
     ========================== */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function bestAnswer()
    {
        return $this->belongsTo(Answer::class, 'best_answer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    /* ==========================
     |   HELPER METHODS
     ========================== */

    public function incrementViews(): void
    {
        $this->views++;
        $this->save();
    }

    public function hasBestAnswer(): bool
    {
        return $this->best_answer_id !== null;
    }
}
