<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        $firstNames = ['Mohamed', 'Ahmed', 'Ali', 'Karim', 'Rachid', 'Farid', 'Nadir',
            'Samir', 'Amine', 'Yacine', 'Fatima', 'Nadia', 'Sofia', 'Lamia',
            'Karima', 'Yamina', 'Selma', 'Inès', 'Meriem', 'Houria',
        ];

        $lastNames = ['Benali', 'Khelifi', 'Mansouri', 'Tahar', 'Bouaziz', 'Hadj',
            'Slimani', 'Djebbar', 'Mekki', 'Zerrouki', 'Ait', 'Ouali',
            'Belkacem', 'Guerfi', 'Rahal', 'Said', 'Cherifi', 'Loucif',
        ];

        $name = $this->faker->randomElement($firstNames).' '.$this->faker->randomElement($lastNames);

        return [
            'name' => $name,
            'email' => strtolower(str_replace(' ', '.', $name)).'@example.dz',
            'phone' => '+213 '.$this->faker->numberBetween(5, 7).$this->faker->numerify(' ## ## ## ##'),
            'message' => $this->faker->randomElement([
                'Bonjour, je suis intéressé par votre bien. Pouvez-vous me contacter pour plus d\'informations ?',
                'Je souhaite visiter la propriété. Merci de me rappeler au plus vite.',
                'Est-ce que le bien est toujours disponible ? Merci de me recontacter.',
                'Pouvez-vous me donner plus de détails sur le prix et les modalités de paiement ?',
                'Je suis très intéressé. Quand puis-je passer pour une visite ?',
            ]),
            'is_read' => $this->faker->boolean(40),
        ];
    }

    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => true,
        ]);
    }

    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,
        ]);
    }
}
