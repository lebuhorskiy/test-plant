<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PlantType;
class PlantTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // можно было создать factory, но т.к у нас данных не много, можно вручную
        $types = ['fruit plant', 'coniferous plant', 'ornamental plant'];

        foreach($types as $type) {
            PlantType::create([
                'title' => $type
            ]);
        }
    }
}
