<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Event;
use App\Models\Session;
use App\Models\Ticket;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNum = max((int) $this->command->ask('Introduce la cantidad de categorias que quieres crear', 3), 1);

        if ($this->command->confirm('Quieres crear eventos para las categorias?', true)) {
            $eventsNum = max((int) $this->command->ask('Introduce la cantidad de eventos que quieres crear para cada categoria', 5), 1);
            Category::factory()->count($categoryNum)->has(Event::factory()->count($eventsNum)->has(Session::factory(SessionEventFactory::class)->count(1)->has(Ticket::factory()->count(2))))->create();
            $this->command->info("Se han creado $categoryNum categorias con $eventsNum eventos cada uno");
        } else{
            Category::factory()->count($categoryNum)->create();
            $this->command->info("Se han creado $categoryNum eventos");
        }
    }
}
