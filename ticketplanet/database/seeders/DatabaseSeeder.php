<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Creem usuaris de proves
        $user=\App\Models\User::create(['name'=>'promotor1','email'=>'promotor1@test.com','password'=>'p12345678']); 
        $user2=\App\Models\User::create(['name'=>'promotor2','email'=>'promotor2@test.com','password'=>'p2345678']); 
        $this->command->info("Creat usuari de proves $user->name, $user->email, p12345678 ");
        $this->command->info("Creat usuari de proves $user2->name, $user2->email, p2345678 ");

        $this->call(CategorySeeder::class);
        $this->call(EventSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(TicketSeeder::class);
    }
}
