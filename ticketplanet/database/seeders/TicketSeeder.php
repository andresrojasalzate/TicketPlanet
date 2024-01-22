<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketNum = max((int) $this->command->ask('Introduce la cantidad de tickets que quieres crear', 5), 1);
        Ticket::factory(TicketFactory::class)->count($ticketNum)->create();
        $this->command->info("Se han creado $ticketNum sessiones");
    }
}
