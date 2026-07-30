<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
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
        $propertyImages = PropertyImage::where('property_id', $property->id)->get();
        return view('public.property-details', compact('property', 'propertyImages'));
    }
}
