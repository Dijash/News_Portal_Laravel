@extends('Layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Politics News</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $article)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @else
                    <img src="https://picsum.photos/400/300" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <span class="inline-block bg-blue-500 text-white text-xs px-3 py-1 rounded-full mb-2">Politics</span>
                    <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($article->content, 100) }}</p>
                    <div class="flex justify-between items-center text-xs text-gray-500">
                        <span>{{ $article->created_at->format('M d, Y') }}</span>
                        <span class="text-gray-400">By {{ $article->author }}</span>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-gray-500 col-span-full">No politics news available.</p>
        @endforelse
    </div>
</div>
@endsection