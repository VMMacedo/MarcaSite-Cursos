<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PerfilTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(InscritosSeeders::class);
        
    }
}