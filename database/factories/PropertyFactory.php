<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    protected static array $algerianCities = [
        'Alger', 'Oran', 'Constantine', 'Annaba', 'Blida', 'Sétif', 'Tizi Ouzou',
        'Béjaïa', 'Batna', 'Djelfa', 'Sidi Bel Abbès', 'Biskra', 'Tébessa',
        'Skikda', 'Tiaret', 'Bordj Bou Arréridj', 'El Oued', 'Chlef',
        'Souk Ahras', 'Médéa', 'Mostaganem', 'Bouira', 'Boumerdès',
        'Jijel', 'Guelma', 'M\'sila', 'Laghouat', 'Ouargla',
        'Tamanrasset', 'Adrar', 'Béchar', 'Tlemcen', 'Saïda', 'Mascara',
    ];

    protected static array $algerianTitles = [
        'Villa moderne avec piscine à',
        'Appartement F3 lumineux à',
        'Magnifique villa traditionnelle à',
        'Terrain constructible à',
        'Duplex de luxe vue mer à',
        'Studio tout équipé à',
        'Ferme oléicole à',
        'Penthouse exceptionnel à',
        'Local commercial à',
        'Maison de village rénovée à',
        'Appartement F4 spacieux à',
        'Bureau moderne à',
        'Immeuble rapport à',
        'Garage sécurisé à',
        'Maison traditionnelle à',
        'Villa avec jardin à',
        'Appartement meublé à',
        'Terrain agricole à',
        'Riad authentique à',
        'Résidence étudiante à',
    ];

    public function definition(): array
    {
        $city = static::$algerianCities[array_rand(static::$algerianCities)];
        $titlePrefix = static::$algerianTitles[array_rand(static::$algerianTitles)];

        $neighbourhoods = ['Centre', 'Hydra', 'Ben Aknoun', 'El Biar', 'Birkhadem',
            'Bab Ezzouar', 'Dely Brahim', 'Chéraga', 'Draria', 'Sidi Yahia',
            'Golf', 'Sidi Fredj', 'El Madania', 'Belouizdad', 'Kouba',
            'Bologhine', 'Aïn Naâdja', 'Bourouba', 'El Harrach', 'Baba Hassen',
        ];

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $titlePrefix.' '.$city
                .($this->faker->boolean(30) ? ' - '.$neighbourhoods[array_rand($neighbourhoods)] : ''),
            'description' => $this->faker->randomElement([
                'Magnifique propriété située dans un quartier calme et résidentiel. Prestations de qualité, finitions soignées, proche de toutes les commodités.',
                'Belle opportunité d\'investissement. Bien entretenu, idéal pour famille. Chauffage central, climatisation, cuisine équipée.',
                'À vendre, charmante propriété avec une vue imprenable. Proche des écoles, transports et commerces.',
                'Superbe propriété rénovée récemment avec des matériaux de haute qualité. Prestations modernes et design contemporain.',
                'Profitez de cet espace unique alliant confort et élégance. Grand séjour, cuisine ouverte, chambres spacieuses.',
                'Propriété exceptionnelle avec finitions de luxe. Piscine, jardin paysager, garage double. Sécurité 24h/24.',
            ]),
            'price' => $this->faker->randomElement([3500000, 4800000, 5500000, 7200000, 8900000, 12000000, 15000000, 18500000, 22000000, 28000000, 35000000, 45000000]),
            'city' => $city,
            'state' => $this->faker->randomElement(static::$algerianCities),
            'area' => $this->faker->randomFloat(2, 40, 500),
            'bedrooms' => $this->faker->numberBetween(1, 6),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'status' => $this->faker->randomElement(['for sale', 'for sale', 'for sale', 'for sale', 'for sale', 'for sale', 'for sale', 'for rent']),
            'is_featured' => $this->faker->boolean(15),
            'is_active' => $this->faker->boolean(90),
            'main_image' => 'properties/placeholder-'.$this->faker->uuid().'.jpg',
        ];
    }

    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'available',
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
