<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();

        return view('admin.addproperty', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'area' => 'nullable|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'status' => 'required|in:for sale,for rent',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'main_image.image' => 'The main image must be an image.',
            'main_image.mimes' => 'The main image must be a file of type: jpeg, png, jpg, gif, webp.',
            'additional_images.*.image' => 'Each additional image must be an image.',
            'additional_images.*.mimes' => 'Each additional image must be a file of type: jpeg, png, jpg, gif, webp.',
            'additional_images.*.max' => 'Each additional image may not be greater than 2MB.',
        ]);

        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('property_images', 'public');
        }

        $property = Property::create(
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'category_id' => $validated['category_id'],
                'user_id' => Auth::id(),
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'area' => $validated['area'] ?? null,
                'bedrooms' => $validated['bedrooms'] ?? null,
                'bathrooms' => $validated['bathrooms'] ?? null,
                'status' => $validated['status'],
                'is_featured' => $request->boolean('is_featured'),
                'is_active' => $request->boolean('is_active'),
                'main_image' => $mainImagePath ? basename($mainImagePath) : null,
            ]
        );

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create(['image_path' => basename($path)]);
            }
        }

        return redirect()->route('admin.properties')->with('success', 'Property added successfully.');
    }

    public function edit($id)
    {

        $property = Property::with('images')->findOrFail($id);
        $categories = Category::all(); // Assuming you have a Category model

        return view('admin.editproperty', compact('property', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'area' => 'nullable|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'status' => 'required|in:for sale,for rent',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $property->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'area' => $validated['area'] ?? null,
            'bedrooms' => $validated['bedrooms'] ?? null,
            'bathrooms' => $validated['bathrooms'] ?? null,
            'status' => $validated['status'],
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('property_images', 'public');

            if ($property->main_image) {
                Storage::disk('public')->delete('property_images/'.$property->main_image);
            }

            $property->main_image = basename($mainImagePath);
        }

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create(['image_path' => basename($path)]);
            }
        }

        $property->save();

        return redirect()->route('admin.properties')->with('success', 'Property updated successfully.');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->main_image) {
            Storage::disk('public')->delete('property_images/'.$property->main_image);
        }

        foreach ($property->images as $image) {
            Storage::disk('public')->delete('property_images/'.$image->image_path);
            $image->delete();
        }

        $property->delete();

        return redirect()->route('admin.properties')
            ->with('success', 'Property deleted successfully.');
    }
}
