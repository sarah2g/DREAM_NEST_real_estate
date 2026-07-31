<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function sale()
    {
        $SaleProperties = Property::where('status', 'for sale')->get();

        return view('public.sale', compact('SaleProperties'));
    }

    public function rent()
    {
        $RentProperties = Property::where('status', 'for rent')->get();

        return view('public.rent', compact('RentProperties'));
    }

    public function show(Property $property)
    {
        $propertyImages = PropertyImage::where('property_id', $property->id)->pluck('image_path');

        $images = collect($property->main_image ? [$property->main_image] : [])
            ->merge($propertyImages)
            ->unique()
            ->values();

        return view('public.property-details', compact('property', 'images'));
    }

    public function makefavorites(Property $property)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->favorites()->syncWithoutDetaching($property->id);

        return redirect()->back();
    }
    public function cancelfavorites(Property $property)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->favorites()->detach($property->id);

        return redirect()->back();
    }
}
