<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
class adminPropertyController extends Controller
{
    public function index()
    {
        // Logic to retrieve properties for the admin dashboard
        $properties = Property::with(['category', 'user'])->latest()->get();

        return view('admin.allproperties', compact('properties'));
    }
    public function addProperty()
    {
        // Logic to show the form for adding a new property
        return view('admin.addproperty');
    }
    public function store(Request $request){
      

    }
}

