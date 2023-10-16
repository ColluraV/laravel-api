<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "Frontend",
            "BackEnd",
            "Bootsrap",
            "FullStack",
            "DataDesign",
        ];
        foreach ($types as $type) {
            $newType = new Type();
            $newType->label = $type;
            $newType->save();
        }
    }
}
