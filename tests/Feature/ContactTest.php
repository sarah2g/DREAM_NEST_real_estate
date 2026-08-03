<?php

use App\Models\Contact;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

test('authenticated user can view the contact form', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('contact'))
        ->assertOk()
        ->assertSee('Contactez-nous')
        ->assertSee('Envoyer le message');
});

test('authenticated user can submit a contact message', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('contact.store'), [
            'name' => 'Sarah',
            'email' => 'sarah@example.com',
            'phone' => '0550000000',
            'message' => 'Bonjour, je suis intéressée par un appartement à Alger.',
        ])
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseHas('contacts', [
        'name' => 'Sarah',
        'email' => 'sarah@example.com',
        'phone' => '0550000000',
        'message' => 'Bonjour, je suis intéressée par un appartement à Alger.',
    ]);
});

test('contact message requires name, email and message', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ])
        ->assertSessionHasErrors(['name', 'email', 'message']);

    $this->assertDatabaseCount('contacts', 0);
});

test('admin can view contact messages', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Contact::factory()->create(['name' => 'Test User', 'message' => 'Hello admin']);

    actingAs($admin)
        ->get(route('admin.contacts'))
        ->assertOk()
        ->assertSee('Test User')
        ->assertSee('Hello admin');
});

test('non-admin users cannot view contact messages', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('admin.contacts'))
        ->assertRedirect();
});

test('admin can toggle a message read status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $contact = Contact::factory()->create(['is_read' => false]);

    actingAs($admin)
        ->patch(route('admin.contacts.read', $contact->id))
        ->assertRedirect()
        ->assertSessionHas('success');

    expect($contact->fresh()->is_read)->toBeTrue();
});

test('admin can delete a contact message', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $contact = Contact::factory()->create();

    actingAs($admin)
        ->delete(route('admin.contacts.destroy', $contact->id))
        ->assertRedirect()
        ->assertSessionHas('success');

    expect(Contact::find($contact->id))->toBeNull();
});

