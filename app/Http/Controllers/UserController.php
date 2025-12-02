<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('role', 'user') // Hanya ambil pengguna dengan role "user"
                      ->where('name', 'like', '%' . $search . '%') // Pencarian berdasarkan nama
                      ->get();
    
        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Tampilkan view edit dengan data user
        return view('admin.user.edit', compact('user'));
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input, email akan tetap unik kecuali untuk user ini sendiri
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'max:255'],
        ]);
    
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
    
        // Update password jika diisi, jika tidak maka abaikan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Simpan perubahan ke database
        $user->save();
    
        // Redirect kembali ke halaman index user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Hapus user
        $user->delete();
    
        // Redirect kembali ke halaman index user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
