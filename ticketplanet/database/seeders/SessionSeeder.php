<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Session;
use App\Models\Ticket;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $sessionNum = max((int) $this->command->ask('Introduce la cantidad de sessiones que quieres crear', 5), 1);
      Session::factory(SessionFactory::class)->count($sessionNum)->has(Ticket::factory(TicketSessionFactory::class)->count(1))->create();
      $this->command->info("Se han creado $sessionNum sessiones");
    }
}
