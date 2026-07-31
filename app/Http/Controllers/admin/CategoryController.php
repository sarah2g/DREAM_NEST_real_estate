<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        // Logic to retrieve categories for the admin dashboard
        $categories = Category::latest()->get();

        return view('admin.allcategories', compact('categories'));
    }
}