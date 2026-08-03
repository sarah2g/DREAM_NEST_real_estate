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
