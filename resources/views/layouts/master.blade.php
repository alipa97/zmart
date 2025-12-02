<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Tambahkan CSS Leaflet langsung dari CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- icon -->
    <link rel="icon" href="{{ asset('img/logo baznas bontang.png') }}" type="image/png">
    
    <style>
        #map { height: 500px; }
        .dropdown-content {
            display: none;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-col flex-1 h-screen overflow-hidden bg-gray-200">
        <!-- Navbar -->
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('img/logo baznas bontang.png') }}" alt="Logo Baznas Bontang" class="w-12 h-12 object-contain">
                <a href="{{ route('pages.home') }}">
                    <span class="text-2xl font-semibold text-indigo-600">BAZNAS BONTANG</span>
                </a>
            </div>

            <!-- Navbar Right -->
            <div class="flex items-center">
                <!-- Dropdown Menu di kanan -->
                <div x-data="{ dropdownOpen: false }" class="relative mr-4"> <!-- Menambahkan margin kanan -->
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white rounded-full">
                        Menu
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 w-48 mt-2 bg-white rounded-lg shadow-lg">
                        <a href="{{ route('pages.home') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white rounded-lg">Home</a>
                        <a href="{{ route('daftarKios.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white rounded-lg">Kios</a>
                        <a href="{{ route('semua-infaq.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white rounded-lg">Infaq Kios</a>
                        <a href="{{ route('kios.map') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-600 hover:text-white rounded-lg">Peta</a>
                    </div>
                </div>

                <!-- Jika belum login (guest) tampilkan tombol Login dan Register -->
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-600 hover:text-white hover:bg-indigo-600 rounded-full mr-4">Login</a>
                @endguest

                <!-- Jika sudah login (auth) tampilkan dropdown Profile dan Logout -->
                @auth
                    <div x-data="{ dropdownOpen: false }" class="relative ml-4">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"
                            style="display: none;"></div>

                        <div x-show="dropdownOpen"
                            class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-indigo-600 hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container px-8 py-6 mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
