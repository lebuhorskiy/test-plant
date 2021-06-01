<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantProtectionProduct;
class PlanProtectionProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // можно было создать factory, но т.к у нас данных не много, можно вручную
        $products = ['Actara', 'Ridomil Gold', 'Topaz', 'Konfidor Maxi'];

        foreach($products as $product) {
            PlantProtectionProduct::create([
                'title' => $product
            ]);
        }
    }
}
