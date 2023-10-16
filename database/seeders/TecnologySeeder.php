<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $tecnologies = [
                "HTML",
                "CSS",
                "Bootsrap",
                "JavaScript",
                "GitHub",
                "Vue.js",
                "PHP",
                "MySql",
                "Laravel",
                "Sass",
            ];
            foreach ($tecnologies as $Tecnology) {
                $newTecnology = new Tecnology();
                $newTecnology->name = $Tecnology;
                $newTecnology->save();
            }
        
    }
}
