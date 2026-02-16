@extends ('Layouts.adminApp')
@section('adminContent')
<div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white dark:bg-gray-900 shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold">News Management</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Manage all news articles
            </p>
        </div>

    <a href="{{ route('admin.addNews') }}"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
            + Add News
        </a>
    </header>

    <!-- Content -->
    <main class="flex-1 px-6 py-8">

        <div class="bg-white dark:bg-gray-900 rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">

                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                            Published At
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach($newsList as $news)
                    <!-- Row -->
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">
                            {{ $news->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $news->category }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $news->published_at ? $news->published_at->format('M d, Y') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($news->is_approved)
                                <span class="inline-block px-2 py-1 text-xs rounded bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">Published</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-3">
                            <div class="flex justify-end gap-2">
                                @if(auth()->user()?->is_admin && !$news->is_approved)
                                <form action="{{ route('admin.news.approve', $news->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5
                                        rounded-md text-sm font-medium
                                        bg-green-50 text-green-700
                                        hover:bg-green-100 hover:text-green-800
                                        dark:bg-green-900/30 dark:text-green-300
                                        dark:hover:bg-green-900/50
                                        transition">
                                        ✅ Approve
                                    </button>
                                </form>
                                @endif
                                <!-- Edit Button -->
                                <a href="{{ route('admin.editNews', $news->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5
                                    rounded-md text-sm font-medium
                                    bg-blue-50 text-blue-600
                                    hover:bg-blue-100 hover:text-blue-700
                                    dark:bg-blue-900/30 dark:text-blue-400
                                    dark:hover:bg-blue-900/50
                                    transition">
                                    ✏️ Edit
                                </a>

                                <!-- Delete Button -->
                                <button onclick="confirmDelete('{{ $news->id }}')" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-sm font-medium bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition">
                                    🗑️ Delete
                                </button>

                                <!-- Hidden Delete Form -->
                                <form id="delete-form-{{ $news->id }}" action="{{ route('admin.news.delete', $news->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>

</div>
@endsection

@section('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this news article?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection