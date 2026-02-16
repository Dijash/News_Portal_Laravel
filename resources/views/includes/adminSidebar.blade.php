<aside class="w-64 bg-white dark:bg-gray-900 shadow-lg hidden md:flex flex-col">
    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-xl font-bold text-red-600">Admin Panel</h2>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 dark:text-gray-300">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ Request::is('admin') 
                     ? 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold' 
                     : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <span class="text-lg">📊</span>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.newsView') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ Request::is('admin/news-view') 
                     ? 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold' 
                     : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <span class="text-lg">📰</span>
            <span>News Info</span>
        </a>
        
        <a href="{{ route('admin.manageUsers') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ Request::is('admin/manage-users') 
                     ? 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold' 
                     : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <span class="text-lg">🗂️</span>
            <span>Manage Users</span>
        </a>
        
          <a href="{{ route('admin.analytics') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ Request::is('admin/analytics') 
                     ? 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold' 
                     : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <span class="text-lg">📈</span>
            <span>Analytics</span>
        </a>
        
          <a href="{{ route('admin.settings') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ Request::is('admin/settings') 
                     ? 'bg-red-100 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold' 
                     : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
            <span class="text-lg">⚙️</span>
            <span>Settings</span>
        </a>
    </nav>
    
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
            Logged in as <span class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'Admin' }}</span>
        </p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg transition bg-red-600 hover:bg-red-700 text-white font-medium">
                <span class="text-lg">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>