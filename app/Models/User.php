<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points',
        'role',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast untuk kolom tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'points' => 'integer',
    ];

    /* ==========================
     |   RELATIONSHIPS
     ========================== */

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
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
     |   GAMIFICATION SYSTEM
     ========================== */

    /**
     * Tambah poin user
     */
    public function addPoints(int $points): void
    {
        $this->points += $points;
        $this->save();
    }

    /**
     * Ambil badge berdasarkan poin
     */
    public function getBadge(): ?string
    {
        if ($this->points >= 500) {
            return 'Master Forum 🏆';
        }

        if ($this->points >= 100) {
            return 'Penjawab Hebat 💡';
        }

        return null;
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
