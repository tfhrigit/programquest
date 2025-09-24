@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Buat Pertanyaan Baru</h1>

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block font-medium">Judul</label>
            <input type="text" name="title" id="title"
                   class="w-full border px-3 py-2 rounded @error('title') border-red-500 @enderror"
                   value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="body" class="block font-medium">Isi Pertanyaan</label>
            <textarea name="body" id="body" rows="6"
                      class="w-full border px-3 py-2 rounded @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tags" class="block font-medium">Tag (pisahkan dengan koma)</label>
            <input type="text" name="tags" id="tags"
                   class="w-full border px-3 py-2 rounded"
                   value="{{ old('tags') }}">
        </div>

        <div>
            <label for="is_anonymous" class="inline-flex items-center">
                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                       {{ old('is_anonymous') ? 'checked' : '' }}>
                <span class="ml-2">Ajukan secara anonim</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
@endsection
