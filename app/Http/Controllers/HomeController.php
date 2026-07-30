<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::where('is_active', true);

        if ($city = $request->input('city')) {
            $query->where('city', 'like', "%{$city}%");
        }

        if ($categoryId = $request->input('property_type')) {
            $query->where('category_id', $categoryId);
        }

        if ($minPrice = $request->input('min_price')) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice = $request->input('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($bedrooms = $request->input('bedrooms')) {
            $query->where('bedrooms', $bedrooms);
        }

        if ($status = $request->input('sale_or_rent')) {
            $query->where('status', $status === 'sale' ? 'for sale' : 'for rent');
        }

        $properties = $query->latest()->paginate(12)->appends($request->query());

        $lastProperties = Property::where('is_active', true)->latest()->take(6)->get();
        $featuredProperties = Property::where('is_featured', true)->latest()->take(6)->get();
        $categories = Category::all();
        $favoritePropertyIds = Favorite::where('user_id', Auth::id())->pluck('property_id');
        $favoriteProperties = Property::whereIn('id', $favoritePropertyIds)->get();
        $cities = Property::where('is_active', true)->distinct()->pluck('city')->sort()->values();

        $isSearch = $request->anyFilled(['city', 'property_type', 'min_price', 'max_price', 'bedrooms', 'sale_or_rent']);

        return view('public.search', compact(
            'properties', 'lastProperties', 'featuredProperties',
            'categories', 'favoriteProperties', 'cities', 'isSearch'
        ));
    }
}
