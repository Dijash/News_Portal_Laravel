<nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      
      <!-- Logo -->
      <div class="text-2xl font-bold text-red-600">
        NewsPortal
      </div>

      <!-- Menu -->
      <div class="hidden md:flex space-x-6 font-medium">
        <a href="{{ route('home') }}" class="hover:text-red-600 {{ Request::is('/') ? 'text-red-600' : '' }}">Home</a>
        <a href="{{ route('politics') }}" class="hover:text-red-600 {{ Request::is('politics') ? 'text-red-600' : '' }}">Politics</a>
        <a href="{{ route('business') }}" class="hover:text-red-600 {{ Request::is('business') ? 'text-red-600' : '' }}">Business</a>
        <a href="{{ route('technology') }}" class="hover:text-red-600 {{ Request::is('technology') ? 'text-red-600' : '' }}">Technology</a>
        <a href="{{ route('sports') }}" class="hover:text-red-600 {{ Request::is('sports') ? 'text-red-600' : '' }}">Sports</a>
        <a href="{{ route('entertainment') }}" class="hover:text-red-600 {{ Request::is('entertainment') ? 'text-red-600' : '' }}">Entertainment</a>
      </div>

      <!-- Search -->
      <div class="hidden md:block">
        <input 
          type="text" 
          placeholder="Search news..."
          class="border rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-red-500"
        >
      </div>
      <div>
        <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-medium">Login</a>
      </div>

    </div>
  </div>
</nav>
