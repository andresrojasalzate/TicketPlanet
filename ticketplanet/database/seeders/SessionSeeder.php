<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Session;
use App\Models\Event;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(count(Event::all()) > 0){
            $sessionNum = max((int) $this->command->ask('Introduce la cantidad de sessiones que quieres crear', 5), 1);
            Session::factory(SessionFactory::class)->count($sessionNum)->create();
            $this->command->info("Se han creado $sessionNum sessiones");
        } else{
            $this->command->info("No se pueden crear sessiones si no existen eventos en la base de datos");
        }
        
    }
}
