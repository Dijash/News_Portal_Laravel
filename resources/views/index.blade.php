@extends('Layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 mt-4 sm:mt-6">

  <!-- Breaking News -->
  <section class="mb-8">
    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3 mb-4">
      Breaking News
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <!-- Main Breaking (Max 1-2) -->
      @foreach($breakingNews->take(1) as $news)
            <div class="md:col-span-2">
        <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://picsum.photos/800/400' }}"
              class="rounded-lg w-full h-56 sm:h-64 object-cover">

        <h3 class="text-xl font-bold mt-3 hover:text-red-600 cursor-pointer">
          {{ $news->title }}
        </h3>

        <p class="text-gray-600 mt-2 line-clamp-3">
          {{ $news->content }}
        </p>
      </div>
      @endforeach

      <!-- Side News (Max 4) -->
      <div class="space-y-4">
        @foreach($sideNews->take(4) as $news)
        <div class="flex gap-3">
          <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://picsum.photos/200/120' }}"
               class="rounded w-24 sm:w-32 h-16 sm:h-20 object-cover">

          <p class="font-semibold hover:text-red-600 cursor-pointer line-clamp-2">
            {{ $news->title }}
          </p>
        </div>
        @endforeach
      </div>

    </div>
  </section>


  <!-- Latest News Grid -->
  <section>
    <h2 class="text-2xl font-bold border-l-4 border-red-600 pl-3 mb-4">
      Latest News
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($newsList->take(4) as $news)
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://picsum.photos/300/200' }}"
             class="w-full h-48 object-cover">

        <div class="p-3">
          <h4 class="font-bold hover:text-red-600 cursor-pointer line-clamp-2">
            {{ $news->title }}
          </h4>
        </div>
      </div>
      @endforeach
    </div>
  </section>

</main>
@endsection
