<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Favorite;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlgerianSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin DZ',
            'email' => 'admin@dreamnest.dz',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+213 770 12 34 56',
        ]);

        // Regular users (some can act as agents)
        $users = User::factory(10)->create([
            'role' => 'user',
        ]);

        $allUsers = $users;

        // Categories
        $categoryNames = [
            ['Appartement', 'appartement', 'Appartements modernes et traditionnels en ville'],
            ['Villa', 'villa', 'Villas de luxe avec jardins et piscines'],
            ['Maison', 'maison', 'Maisons individuelles et mitoyennes'],
            ['Terrain', 'terrain', 'Terrains constructibles et agricoles'],
            ['Local Commercial', 'local-commercial', 'Locaux pour commerces et boutiques'],
            ['Bureau', 'bureau', 'Espaces de travail et bureaux professionnels'],
            ['Studio', 'studio', 'Studios meublés et équipés'],
            ['Ferme', 'ferme', 'Fermes agricoles et oléicoles'],
            ['Immeuble', 'immeuble', 'Immeubles résidentiels et mixtes'],
            ['Garage', 'garage', 'Garages et places de parking'],
        ];

        $categories = [];
        foreach ($categoryNames as $cat) {
            $categories[] = Category::create([
                'name' => $cat[0],
                'slug' => $cat[1],
                'description' => $cat[2],
            ]);
        }

        // Properties spread across users

        foreach (range(1, 30) as $i) {
            $owner = $allUsers->random();
            $category = $categories[array_rand($categories)];
            $city = $this->getAlgerianCity();
            $status = $i <= 25 ? 'for sale' : 'for rent';

            $property = Property::create([
                'user_id' => $owner->id,
                'category_id' => $category->id,
                'title' => $this->getAlgerianTitle().' '.$city,
                'description' => $this->getDescription(),
                'price' => $this->getPrice(),
                'city' => $city,
                'state' => $this->getAlgerianCity(),
                'area' => rand(40, 500) + round(rand(0, 99) / 100, 2),
                'bedrooms' => rand(1, 6),
                'bathrooms' => rand(1, 4),
                'status' => $status,
                'is_featured' => $i <= 5,
                'is_active' => true,
                'main_image' => 'properties/dz-'.$i.'.jpg',
            ]);

            // Add 2-4 images per property
            foreach (range(1, rand(2, 4)) as $img) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => 'properties/dz-'.$i.'-'.$img.'.jpg',
                ]);
            }
        }

        // Favorites
        $propertyIds = Property::pluck('id')->toArray();
        foreach ($users as $user) {
            $favCount = rand(1, 5);
            $favProperties = fake()->randomElements($propertyIds, $favCount);
            foreach ($favProperties as $propertyId) {
                Favorite::firstOrCreate([
                    'user_id' => $user->id,
                    'property_id' => $propertyId,
                ]);
            }
        }

        // Contact messages from random users
        foreach (range(1, 15) as $i) {
            $user = $users->random();

            Contact::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'message' => $this->getContactMessage(),
                'is_read' => rand(0, 1),
            ]);
        }

        // Some contacts from non-registered people
        foreach (range(1, 5) as $i) {
            Contact::factory()->create();
        }
    }

    private function getAlgerianCity(): string
    {
        $cities = [
            'Alger', 'Oran', 'Constantine', 'Annaba', 'Blida', 'Sétif', 'Tizi Ouzou',
            'Béjaïa', 'Batna', 'Djelfa', 'Sidi Bel Abbès', 'Biskra', 'Tébessa',
            'Skikda', 'Tiaret', 'Bordj Bou Arréridj', 'El Oued', 'Chlef',
            'Souk Ahras', 'Médéa', 'Mostaganem', 'Bouira', 'Boumerdès',
            'Jijel', 'Guelma', 'M\'sila', 'Laghouat', 'Ouargla',
            'Tamanrasset', 'Adrar', 'Béchar', 'Tlemcen', 'Saïda', 'Mascara',
        ];

        return $cities[array_rand($cities)];
    }

    private function getAlgerianTitle(): string
    {
        $titles = [
            'Villa moderne avec piscine à', 'Appartement F3 lumineux à',
            'Magnifique villa traditionnelle à', 'Terrain constructible à',
            'Duplex de luxe vue mer à', 'Studio tout équipé à',
            'Ferme oléicole à', 'Penthouse exceptionnel à',
            'Local commercial à', 'Maison de village rénovée à',
            'Appartement F4 spacieux à', 'Bureau moderne à',
            'Immeuble rapport à', 'Garage sécurisé à',
            'Maison traditionnelle à', 'Villa avec jardin à',
            'Appartement meublé à', 'Terrain agricole à',
            'Riad authentique à', 'Résidence universitaire à',
        ];

        return $titles[array_rand($titles)];
    }

    private function getDescription(): string
    {
        $descriptions = [
            'Magnifique propriété située dans un quartier calme et résidentiel d\'Alger. Prestations de qualité, finitions soignées, proche de toutes les commodités. Transport à proximité, écoles, commerces et espaces verts.',
            'Belle opportunité d\'investissement. Bien entretenu, idéal pour famille nombreuse. Chauffage central, climatisation réversible, cuisine équipée, dressing. Visite libre le week-end.',
            'À vendre, charmante propriété avec une vue imprenable sur la baie. Proche des écoles, transports et commerces. Quartier sécurisé avec gardiennage 24h/24.',
            'Superbe propriété rénovée récemment avec des matériaux de haute qualité. Prestations modernes et design contemporain. Cuisine américaine fully équipée, salle de bain en marbre.',
            'Profitez de cet espace unique alliant confort et élégance. Grand séjour sur salon, cuisine ouverte, chambres spacieuses avec placards. Balcon filant avec vue dégagée.',
            'Propriété exceptionnelle avec finitions de luxe. Piscine chauffée, jardin paysager, garage double, cave. Sécurité 24h/24, cité résidentielle calme.',
        ];

        return $descriptions[array_rand($descriptions)];
    }

    private function getPrice(): int
    {
        $prices = [3500000, 4800000, 5500000, 7200000, 8900000, 12000000, 15000000, 18500000, 22000000, 28000000, 35000000, 45000000];

        return $prices[array_rand($prices)];
    }

    private function getContactMessage(): string
    {
        $messages = [
            'Bonjour, je suis intéressé par votre bien. Pouvez-vous me contacter pour plus d\'informations ?',
            'Je souhaite visiter la propriété. Merci de me rappeler au plus vite.',
            'Est-ce que le bien est toujours disponible ? Merci de me recontacter.',
            'Pouvez-vous me donner plus de détails sur le prix et les modalités de paiement ?',
            'Je suis très intéressé. Quand puis-je passer pour une visite ?',
            'Bonjour, je voudrais négocier le prix. Est-ce possible d\'avoir une réduction ?',
        ];

        return $messages[array_rand($messages)];
    }
}
