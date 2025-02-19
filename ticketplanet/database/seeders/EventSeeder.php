<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Session;
use App\Models\Ticket;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventsNum = max((int) $this->command->ask('Introduce la cantidad de eventos que quieres crear', 5), 1);
       
        Event::factory()->count($eventsNum)->has(Session::factory(SessionEventFactory::class)->count(1)->has(Ticket::factory()->count(1)))->create();
        $this->command->info("Se han creado $eventsNum eventos");
        
    }
}
