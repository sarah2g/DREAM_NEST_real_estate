<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function showContactForm(Request $request): View
    {
        $propertyId = $request->query('property_id');

        $property = $propertyId
            ? Property::find($propertyId)
            : null;

        return view('public.contact', [
            'propertyId' => $propertyId,
            'property' => $property,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Contact::create($validated);

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons rapidement.');
    }
}
