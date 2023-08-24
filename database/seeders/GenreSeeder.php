<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $genre = new Genre();
     $genre->name = "Cienca Ficción";
     $genre->description = "La ciencia ficción es un género narrativo que sitúa la acción en unas coordenadas espacio-temporales imaginarias y diferentes a las nuestras, y que especula racionalmente sobre posibles avances científicos o sociales y su impacto en la sociedad";
     $genre->save();
     
     $genre2 = new Genre();
     $genre2->name = "Bibliografico";
     $genre2->description = "Es un texto que presenta los resultados cognitivos metodológicos de las diferentes fases que constituyen la investigación divulgada en el texto reseñado";
     $genre2->save();

     $genre3 = new Genre();
     $genre3->name = "Romanticismo";
     $genre3->description = "El Romanticismo es un movimiento cultural que se originó en Alemania y en Reino Unido a finales del siglo XVIII como una reacción contra la Ilustración y el Neoclasicismo, confiriendo prioridad a los sentimientos.";
     $genre3->save();

    }
}