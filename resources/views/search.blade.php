@extends('Layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">Search Results</h1>
        <p class="text-gray-600">Showing results for: <span class="font-semibold text-gray-800">"{{ $query }}"</span></p>
        <p class="text-sm text-gray-500 mt-2">{{ $news->count() }} {{ $news->count() == 1 ? 'result' : 'results' }} found</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $article)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @else
                    <img src="https://picsum.photos/400/300" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <span class="inline-block bg-red-500 text-white text-xs px-3 py-1 rounded-full mb-2 capitalize">{{ $article->category }}</span>
                    <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($article->content, 100) }}</p>
                    <div class="flex justify-between items-center text-xs text-gray-500">
                        <span>{{ $article->created_at->format('M d, Y') }}</span>
                        <span class="text-gray-400">By {{ $article->author }}</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No results found</h3>
                <p class="mt-2 text-gray-500">We couldn't find any news matching "{{ $query }}"</p>
                <p class="mt-1 text-sm text-gray-400">Try different keywords or check your spelling</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Back to Home
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
