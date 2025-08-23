<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Solar Panels', 'description' => 'Photovoltaic solar panels', 'image' => 'images/categories/solar.png'],
            ['name' => 'Batteries', 'description' => 'Storage batteries for solar systems', 'image' => 'images/categories/battery.png'],
            ['name' => 'Inverters', 'description' => 'Power inverters and systems', 'image' => 'images/categories/inverters.jpeg'],
            ['name' => 'Charge Controllers', 'description' => 'Controllers for solar charging', 'image' => 'images/categories/charge_controller.jpg'],
            ['name' => 'Mounting Structures', 'description' => 'Structures for mounting solar panels', 'image' => 'images/categories/mounting.jpg'],
            ['name' => 'Cables & Connectors', 'description' => 'Cables and electrical connectors', 'image' => 'images/categories/cables.jpg'],
            ['name' => 'Lighting Systems', 'description' => 'LED and other lighting solutions', 'image' => 'images/categories/lighting.jpg'],
            ['name' => 'Smart Meters', 'description' => 'Energy smart metering devices', 'image' => 'images/categories/smart_meter.jpg'],
            ['name' => 'Generators', 'description' => 'Backup power generators', 'image' => 'images/categories/generator.jpg'],
            ['name' => 'Hybrid Systems', 'description' => 'Combined solar and other energy systems', 'image' => 'images/categories/hybrid.jpg'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
