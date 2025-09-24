<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Simpan komentar
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'question_id' => $request->question_id,
            'answer_id'   => $request->answer_id,
            'user_id'     => Auth::id(),
            'body'        => $request->body,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
