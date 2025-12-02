<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ListAdminController extends Controller
{
    public function index()
    {
        // Mengambil user yang role-nya admin
        $admins = User::where('role', 'admin')->get();
        // dd("hello");
        return view('admin.new_admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.new_admin.create');
    }
}
