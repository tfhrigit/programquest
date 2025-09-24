<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Daftar pertanyaan
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    // Form buat pertanyaan
    public function create()
    {
        return view('questions.create');
    }

    // Simpan pertanyaan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);

        Question::create([
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'body'         => $request->body,
            'tags'         => $request->tags,
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dibuat!');
    }

    // Detail pertanyaan
    public function show($id)
    {
        $question = Question::with(['user', 'answers.user', 'comments.user'])->findOrFail($id);
        return view('questions.show', compact('question'));
    }
}
