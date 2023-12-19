<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Session;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventsNum = max((int) $this->command->ask('Introduce la cantidad de eventos que quieres crear', 5), 1);

        if ($this->command->confirm('Quieres crear sessiones para los eventos?', true)) {
            $sessionsNum = max((int) $this->command->ask('Introduce la cantidad de sessiones que quieres crear para cada evento', 2), 1);
            Event::factory()->count($eventsNum)->has(Session::factory(SessionEventFactory::class)->count($sessionsNum))->create();
            $this->command->info("Se han creado $eventsNum eventos con $sessionsNum sessiones cada uno");
        } else{
            Event::factory()->count($eventsNum)->create();
            $this->command->info("Se han creado $eventsNum eventos");
        }
        
        
    }
}
