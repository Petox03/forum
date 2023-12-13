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
        //Crea a un usuario predeterminado
        \App\Models\User::factory()->create(['name' => 'Alberto Sosa' ,'email' => 'petox.somart@outlook.com', 'password' => '$2y$10$x/.q8JLSZvoLZmlVvZWMYeqblUgg/ZLlxJDnWRP9VPgHo33ByPBq6']);
        //Crea usuarios aleatorios
        \App\Models\User::factory(9)->create();

        //Crea categorías aleatorias
        \App\Models\Category::factory(10)
            //Crea 20 preguntas por categoría
            ->hasThreads(20)
            ->create();

        //Crea 400 respuestas aleatorias
        \App\Models\Reply::factory(400)->create();
    }
}
