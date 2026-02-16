@extends('Layouts.adminApp')

@section('adminContent')
<main class="flex-1 px-4 sm:px-6 py-6 sm:py-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow p-6 sm:p-8">

        <h2 class="text-2xl font-bold mb-6">Edit News</h2>

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium mb-1">News Title</label>
                <input 
                    type="text"
                    name="title"
                    required
                    value="{{ old('title', $news->title) }}"
                    placeholder="Enter news title"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300
                    dark:border-gray-700 bg-white dark:bg-gray-800
                    focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium mb-1">Category</label>
                <select 
                    name="category"
                    required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300
                    dark:border-gray-700 bg-white dark:bg-gray-800
                    focus:ring-2 focus:ring-red-500 outline-none">

                    <option value="">Select Category</option>
                    <option value="politics" {{ old('category', $news->category) == 'politics' ? 'selected' : '' }}>Politics</option>
                    <option value="technology" {{ old('category', $news->category) == 'technology' ? 'selected' : '' }}>Technology</option>
                    <option value="sports" {{ old('category', $news->category) == 'sports' ? 'selected' : '' }}>Sports</option>
                    <option value="business" {{ old('category', $news->category) == 'business' ? 'selected' : '' }}>Business</option>
                    <option value="entertainment" {{ old('category', $news->category) == 'entertainment' ? 'selected' : '' }}>Entertainment</option>
                </select>
            </div>

            <!-- Current Image Display -->
            @if($news->image)
            <div>
                <label class="block text-sm font-medium mb-1">Current Image</label>
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium mb-1">Featured Image {{ $news->image ? '(Upload new to replace)' : '' }}</label>
                <input 
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full text-sm text-gray-600 dark:text-gray-400
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:bg-red-50 file:text-red-600
                    hover:file:bg-red-100
                    dark:file:bg-gray-800 dark:file:text-red-400">
            </div>
            
            <!-- News Source URL -->
            <div>
                <label class="block text-sm font-medium mb-1">
                    News Source URL (Optional)
                </label>
                <input 
                    type="url"
                    name="url"
                    value="{{ old('url', $news->url) }}"
                    placeholder="https://example.com/news"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300
                    dark:border-gray-700 bg-white dark:bg-gray-800
                    focus:ring-2 focus:ring-red-500 outline-none">
            </div>

            <!-- Content -->
            <div>
                <label class="block text-sm font-medium mb-1">News Content</label>
                <textarea 
                    rows="6"
                    name="content"
                    required
                    placeholder="Write the news content here..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300
                    dark:border-gray-700 bg-white dark:bg-gray-800
                    focus:ring-2 focus:ring-red-500 outline-none">{{ old('content', $news->content) }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">

                <!-- Cancel (Anchor styled like button) -->
                <a href="{{ route('admin.newsView') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-800
                   hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>

                <!-- Submit -->
                <button 
                    type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white
                    hover:bg-blue-700 transition font-semibold">
                    Update News
                </button>

            </div>

        </form>

    </div>
</main>
@endsection