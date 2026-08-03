<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('admin.contacts', compact('contacts'));
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => ! $contact->is_read]);

        return redirect()->route('admin.contacts')->with('success', 'Message status updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully.');
    }
}
