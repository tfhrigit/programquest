<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $request->validate([
            'value' => 'required|in:1,-1',
        ]);

        $vote = Vote::updateOrCreate(
            [
                'user_id'     => Auth::id(),
                'question_id' => $request->question_id,
                'answer_id'   => $request->answer_id,
            ],
            [
                'value' => $request->value,
            ]
        );

        // Hitung total vote
        $total = Vote::where('question_id', $request->question_id)
                    ->where('answer_id', $request->answer_id)
                    ->sum('value');

        return response()->json(['total' => $total]);
    }
}
