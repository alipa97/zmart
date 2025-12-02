@extends('layouts.admin')

@section('content')
<!-- Form Edit User -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Edit User</h2>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password (Opsional)</label>
                        <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Isi jika ingin mengganti password">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ulangi password baru jika diisi">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
