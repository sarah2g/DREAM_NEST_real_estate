<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Property;
use App\Models\User;

class adminController extends Controller
{
    public function index()
    {
        $nombreProperty = Property::count();
        $nombreUser = User::count();
        $nombreCategory = Category::count();
        $nombreContact = Contact::count();
        $unreadMessages = Contact::where('is_read', false)->count();
        $lastProperties = Property::with(['category', 'user'])->latest()->take(5)->get();
        $lastusers = User::latest()->take(5)->get();
        $lastcategories = Category::withCount('properties')->latest()->take(5)->get();

        return view('admin.index', compact('nombreProperty', 'nombreUser', 'nombreCategory', 'nombreContact', 'unreadMessages', 'lastProperties', 'lastusers', 'lastcategories'));
    }
}
