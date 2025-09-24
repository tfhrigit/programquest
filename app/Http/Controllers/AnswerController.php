<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    // Simpan jawaban
    public function store(Request $request, $questionId)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Answer::create([
            'question_id'  => $questionId,
            'user_id'      => Auth::id(),
            'body'         => $request->body,
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return redirect()->route('questions.show', $questionId)->with('success', 'Jawaban berhasil ditambahkan!');
    }

    // Tandai jawaban terbaik
    public function best($id)
    {
        $answer = Answer::findOrFail($id);
        $question = $answer->question;

        // update best_answer_id
        $question->best_answer_id = $answer->id;
        $question->save();

        // +10 poin ke user jawaban
        $answer->user->increment('points', 10);

        return back()->with('success', 'Jawaban ditandai sebagai terbaik!');
    }
}
