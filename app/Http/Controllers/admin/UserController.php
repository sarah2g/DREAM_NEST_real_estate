<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        // Logic to retrieve users for the admin dashboard
        $users = User::latest()->get();

        return view('admin.allusers', compact('users'));
    }
}
