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
        $this->call(PlantTypesSeeder::class);
        $this->command->info('Таблица типов растений была заполнена!');
        $this->call(PlanProtectionProductsSeeder::class);
        $this->command->info('Таблица с продуктами защиты растений была заполнена!');
    }
}
