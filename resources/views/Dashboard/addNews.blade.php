
@extends('Layouts.adminApp')

@section('adminContent')
<main class="flex-1 px-6 py-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow p-8">

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium mb-1">News Title</label>
                <input 
                    type="text"
                    name="title"
                    required
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
                    <option value="politics">Politics</option>
                    <option value="business">Business</option>
                    <option value="sports">Sports</option>
                    <option value="technology">Technology</option>
                    <option value="entertainment">Entertainment</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium mb-1">Featured Image</label>
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
                    focus:ring-2 focus:ring-red-500 outline-none"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">

                <!-- Cancel (Anchor styled like button) -->
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-800
                   hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>

                <!-- Submit -->
                <button 
                    type="submit"
                    class="px-6 py-2 rounded-lg bg-red-600 text-white
                    hover:bg-red-700 transition font-semibold">
                    Publish News
                </button>

            </div>

        </form>

    </div>
</main>
@endsection