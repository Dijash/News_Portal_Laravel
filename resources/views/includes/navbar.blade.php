<nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      
      <!-- Logo -->
      <div class="text-2xl font-bold text-red-600">
        NewsPortal
      </div>

      <!-- Mobile Menu Button -->
      <button type="button" id="mobileMenuButton" class="md:hidden p-2 rounded-lg border border-gray-200 hover:bg-gray-50" aria-label="Toggle menu">
        ☰
      </button>

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
        <form action="{{ route('search') }}" method="GET" class="flex">
          <input 
        type="text" 
        name="query"
        placeholder="Search news..."
        class="border rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-red-500"
        required
          >
          <button type="submit" class="ml-2 px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">
        Search
          </button>
        </form>
      </div>
      <div class="hidden md:flex gap-3">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
              Logout
            </button>
          </form>
        @endauth
        @guest
          <a href="{{ route('login') }}" class="px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 font-medium">Login</a>
          <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">Sign Up</a>
        @endguest
      </div>

    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden hidden pb-4 space-y-4">
      <div class="flex flex-col gap-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-red-600 {{ Request::is('/') ? 'text-red-600' : '' }}">Home</a>
        <a href="{{ route('politics') }}" class="hover:text-red-600 {{ Request::is('politics') ? 'text-red-600' : '' }}">Politics</a>
        <a href="{{ route('business') }}" class="hover:text-red-600 {{ Request::is('business') ? 'text-red-600' : '' }}">Business</a>
        <a href="{{ route('technology') }}" class="hover:text-red-600 {{ Request::is('technology') ? 'text-red-600' : '' }}">Technology</a>
        <a href="{{ route('sports') }}" class="hover:text-red-600 {{ Request::is('sports') ? 'text-red-600' : '' }}">Sports</a>
        <a href="{{ route('entertainment') }}" class="hover:text-red-600 {{ Request::is('entertainment') ? 'text-red-600' : '' }}">Entertainment</a>
      </div>

      <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
        <input
          type="text"
          name="query"
          placeholder="Search news..."
          class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
          required
        >
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
          Search
        </button>
      </form>

      <div class="flex flex-col sm:flex-row gap-3">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
              Logout
            </button>
          </form>
        @endauth
        @guest
          <a href="{{ route('login') }}" class="px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 font-medium text-center">Login</a>
          <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-center">Sign Up</a>
        @endguest
      </div>
    </div>
  </div>
</nav>
@auth
  <div class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 py-2 text-sm text-gray-600">
      Logged in as <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
    </div>
  </div>
@endauth

<script>
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileMenu = document.getElementById('mobileMenu');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
</script>
