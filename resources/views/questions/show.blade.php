@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold">{{ $question->title }}</h1>
        <p class="text-gray-700 mt-2">{{ $question->body }}</p>
        <p class="text-sm text-gray-500 mt-1">
            Ditanyakan oleh
            {{ $question->is_anonymous ? 'Anonim' : $question->user->name }}
            · {{ $question->created_at->diffForHumans() }}
        </p>
        @if($question->tags)
            <p class="mt-2">
                @foreach(explode(',', $question->tags) as $tag)
                    <span class="bg-gray-200 px-2 py-1 rounded text-sm">#{{ trim($tag) }}</span>
                @endforeach
            </p>
        @endif
    </div>

    <hr class="my-4">

    <h2 class="text-2xl font-semibold mb-4">Jawaban</h2>
    @if($question->answers->count())
        <div class="space-y-4">
            @foreach($question->answers as $answer)
                <div class="p-4 border rounded bg-white">
                    <p>{{ $answer->body }}</p>
                    <small class="text-gray-500">
                        Dijawab oleh {{ $answer->user->name }} · {{ $answer->created_at->diffForHumans() }}
                    </small>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Belum ada jawaban.</p>
    @endif

    <hr class="my-4">

    <h2 class="text-xl font-semibold mb-2">Tulis Jawaban</h2>
    <form action="{{ route('answers.store', $question->id) }}" method="POST" class="space-y-3">
        @csrf
        <textarea name="body" rows="4"
                  class="w-full border px-3 py-2 rounded @error('body') border-red-500 @enderror"
                  placeholder="Tulis jawabanmu...">{{ old('body') }}</textarea>
        @error('body')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Kirim Jawaban
        </button>
    </form>
@endsection
