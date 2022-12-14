<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        EquipmentType::factory(10)->create()->each(function (EquipmentType $type) {
            Equipment::factory(2)->create([
                'type_id' => $type->id,
            ]);
        });
    }
}
