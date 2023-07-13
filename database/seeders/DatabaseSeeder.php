<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TicketSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
 
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TicketSeeder::class,
        ]);
    }
    }

