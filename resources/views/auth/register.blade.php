@extends('layouts.admin')

@section('content')
<!-- Form Tambah Pengguna -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Tambah Pengguna</h2>

            <form method="POST" action="{{ route('admin.register.store') }}">
                @csrf

                <input type="hidden" name="role" value="user">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Pengguna -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nama Pengguna</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Pengguna" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required placeholder="Password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded-lg" required placeholder="Konfirmasi Password">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
