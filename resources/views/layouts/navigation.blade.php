<!-- resources/views/layouts/navigation.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Horizontal Navbar -->
<nav class="fixed w-full bg-white shadow-md font-nunito z-50">
  <div class="flex float-right items-center justify-between py-4 px-6">
    <div class="lg:hidden">
      <button id="hamburger" class="text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
    </div>
    <div class="hidden lg:flex">
      <a href="{{ route('profile.edit') }}" class="ml-6 text-black hover:bg-blue-900 hover:text-white px-4 py-2 rounded-md">Profile</a>
  <!-- Logout Form -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Logout Link -->
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="ml-6 text-black hover:bg-blue-900 hover:text-white px-4 py-2 rounded-md">
            Logout
        </a>
    </div>
  </div>
</nav>

<!-- Vertical Navbar -->
<nav id="vertical-nav" class="fixed top-0 left-0 w-1/5 h-full bg-blue-900 text-white font-nunito transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:w-1/5">
  <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full mt-14 p-4">
  
  <ul class="list-none p-0">
    <li><a href="/dashboard" class="block py-4 px-6 hover:bg-blue-800">Dashboard</a></li>
    <li><a href="{{ route('usertasks.index') }}" class="block py-4 px-6 hover:bg-blue-800 hover:text-white">My Task</a></li>
    <li><a href="{{ route('chat.index') }}" class="block py-4 px-6 hover:bg-blue-800">Chat</a></li>
    <li><a href="{{ route('setting.index') }}" class="block py-4 px-6 hover:bg-blue-800">Settings</a></li>

    <!-- Make "Forms" a direct link instead of a dropdown -->
    <li>
      <a href="{{ route('forms.index') }}" class="block py-4 px-6 hover:bg-blue-800">Forms</a>
    </li>

    <li class="relative group">
      <a href="#" class="block py-4 px-6 hover:bg-blue-800">Notifications 
        <span class="bg-red-500 text-white rounded-full px-2 py-1 text-xs">{{ auth()->user()->unreadNotifications()->count() }}</span>
      </a>
      <ul class="absolute left-full hidden mt-2 bg-gray-100 text-black group-hover:block">
        @foreach(auth()->user()->unreadNotifications as $notification)
          <li><a href="{{ $notification->data['url'] }}" class="block py-2 px-6 hover:bg-gray-300">{{ $notification->data['message'] }}</a></li>
        @endforeach
      </ul>
    </li>
    <li><a href="{{ route('inventory.index') }}" class="block py-4 px-6 hover:bg-blue-800">Inventory</a></li>
  </ul>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 hidden lg:hidden">
  <div class="flex justify-end p-4">
    <button id="close-menu" class="text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
  </div>
  <div class="flex flex-col items-center justify-center h-full text-white">
    <a href="#" class="py-4 px-6 hover:bg-blue-700">Dashboard</a>
    <a href="{{ route('usertasks.index') }}" class="py-4 px-6 hover:bg-blue-700">My Task</a>
    <a href="{{ route('chat.index') }}" class="py-4 px-6 hover:bg-blue-700">Chat</a>
    <a href="{{ route('setting.index') }}" class="py-4 px-6 hover:bg-blue-700">Settings</a>
    <div class="relative">
      <a href="#" class="py-4 px-6 hover:bg-blue-700">Forms</a>
      <div class="absolute hidden bg-gray-100 text-black p-4">
        <a href="{{ route('iar.index') }}" class="block py-2 hover:bg-gray-300">IAR Form</a>
        <a href="{{ route('stock.index') }}" class="block py-2 hover:bg-gray-300">Stock Card</a>
        <a href="{{ route('ris.index') }}" class="block py-2 hover:bg-gray-300">RIS</a>
        <a href="{{ route('property.index') }}" class="block py-2 hover:bg-gray-300">Property Card</a>
        <a href="{{ route('wmr.index') }}" class="block py-2 hover:bg-gray-300">Semi-Property Card</a>
      </div>
    </div>
    <div class="relative">
      <a href="#" class="py-4 px-6 hover:bg-blue-700">Notifications</a>
      <div class="absolute hidden bg-gray-100 text-black p-4">
        @foreach(auth()->user()->unreadNotifications as $notification)
          <a href="{{ $notification->data['url'] }}" class="block py-2 hover:bg-gray-300">{{ $notification->data['message'] }}</a>
        @endforeach
      </div>
    </div>
    <a href="{{ route('inventory.index') }}" class="py-4 px-6 hover:bg-blue-700">Inventory</a>
    <a href="{{ route('profile.edit') }}" class="py-4 px-6 hover:bg-blue-700">Profile</a>
    <a href="{{ route('logout') }}" class="py-4 px-6 hover:bg-blue-700">Logout</a>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-menu');
    const verticalNav = document.getElementById('vertical-nav');
    const dropdownButton = document.getElementById('dropdownHoverButton');
    const dropdownMenu = document.getElementById('dropdownHover');

    // Show dropdown on hover
    dropdownButton.addEventListener('mouseenter', () => {
      dropdownMenu.classList.remove('hidden');
    });

    // Hide dropdown when mouse leaves
    dropdownMenu.addEventListener('mouseleave', () => {
      dropdownMenu.classList.add('hidden');
    });

    // Toggle dropdown visibility on button click
    dropdownButton.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
      if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
    hamburger.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });

    closeMenu.addEventListener('click', function() {
      mobileMenu.classList.add('hidden');
    });

    document.querySelectorAll('.relative.group').forEach((element) => {
      element.addEventListener('click', () => {
        const dropdown = element.querySelector('ul');
        dropdown.classList.toggle('hidden');
      });
    });

    // Close dropdowns when clicking outside of them
    document.addEventListener('click', (event) => {
      if (!event.target.closest('.relative.group')) {
        document.querySelectorAll('.relative ul').forEach((dropdown) => {
          dropdown.classList.add('hidden');
        });
      }
    });
  });
</script>
