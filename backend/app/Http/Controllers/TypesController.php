<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantType;
class TypesController extends Controller
{
    public function get()
    {
        $types = PlantType::all();

        return response()->json($types, 200);
    }
}
