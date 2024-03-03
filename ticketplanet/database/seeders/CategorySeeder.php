<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::factory()->create([
            'name' => 'Teatro',
        ]);

        $category = Category::factory()->create([
            'name' => 'Cine',
        ]);

        $category = Category::factory()->create([
            'name' => 'Musica',
        ]);

        $category = Category::factory()->create([
            'name' => 'Deporte',
        ]);

        $category = Category::factory()->create([
            'name' => 'Danza',
        ]);

        $category = Category::factory()->create([
            'name' => 'Benéficos',
        ]);

        $category = Category::factory()->create([
            'name' => 'Viajes',
        ]);

        $category = Category::factory()->create([
            'name' => 'Educativos',
        ]);


        $this->command->info("Se han creado 8 categorias");
    }
}
