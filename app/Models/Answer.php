<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'body',
        'votes',
        'is_anonymous',
    ];

    /* ==========================
     |   RELATIONSHIPS
     ========================== */

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function voteScore(): int
    {
        return $this->votes()->sum('value');
    }

    public function markAsBest(): void
    {
        $this->question->best_answer_id = $this->id;
        $this->question->save();

        // Tambah poin untuk user jawaban terbaik
        $this->user->addPoints(10);
    }
}
