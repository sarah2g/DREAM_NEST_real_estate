<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
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

        $category = $this->faker->unique()->randomElement($categories);

        return [
            'name' => $category[0],
            'slug' => $category[1],
            'description' => $category[2],
        ];
    }
}
