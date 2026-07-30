<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // آخر 6 عقارات + 6 مميزة + كل التصنيفات+ المفضلين
    public function index()
    {
        $lastProperties = Property::where('is_active', true)->latest()->take(6)->get();
        $featuredProperties = Property::where('is_featured', true)->latest()->take(6)->get();
        $categories = Category::all();
        $favoriteProperties = Favorite::where('user_id', Auth::id())->pluck('property_id')->toArray();

        return view('home', compact('lastProperties', 'featuredProperties', 'categories', 'favoriteProperties'));
    }
}
