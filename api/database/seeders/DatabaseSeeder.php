<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Franchise;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea 20 franquicias
        $franchises = Franchise::factory()->count(20)->create();

        // Obtén los ids de los tags existentes
        $tagIds = Tag::pluck('tag_id')->toArray();

        // Adjunta tags aleatorios a cada franquicia
        foreach ($franchises as $franchise) {
            // Selecciona aleatoriamente entre 1 y 3 tags
            $randomTagIds = collect($tagIds)->random(random_int(1, 3));

            // Adjunta los tags seleccionados a la franquicia
            $franchise->tags()->attach($randomTagIds);
        }
    }
}
