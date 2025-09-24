@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Daftar Pertanyaan</h1>

    <a href="{{ route('questions.create') }}" class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded">
        + Buat Pertanyaan
    </a>

    @if($questions->count())
        <div class="space-y-4">
            @foreach($questions as $question)
                <div class="p-4 border rounded bg-gray-50">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('questions.show', $question->id) }}" class="text-blue-600 hover:underline">
                            {{ $question->title }}
                        </a>
                    </h2>
                    <p class="text-gray-700">{{ Str::limit($question->body, 120) }}</p>
                    <small class="text-gray-500">
                        Ditanyakan oleh {{ $question->user->name }} · {{ $question->created_at->diffForHumans() }}
                    </small>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $questions->links() }}
        </div>
    @else
        <p class="text-gray-600">Belum ada pertanyaan.</p>
    @endif
@endsection
