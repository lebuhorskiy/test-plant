<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantProtectionProduct;
class ProtectionProductsController extends Controller
{
    public function get()
    {
        $products = PlantProtectionProduct::all();

        return response()->json($products, 200);
    } 
}
