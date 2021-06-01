<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlantRequest;
use App\Models\Plant;
use App\Services\PlantsService;

class PlantsController extends Controller
{
    public function get(PlantsService $service)
    {
        try {
            $plants = $service->getAllPlants();
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($plants, 200);
    }


    public function find(Request $request, PlantsService $service)
    {
        try {
            $find = $service->findById($request);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if(!$find) {
            return response()->json(['error' => 'plant not found'], 404);
        }

        return response()->json($find, 200);
    }


    public function update(PlantRequest $request, PlantsService $service) {
        try {
            $service->update($request);   
        } catch(\Execetion $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function create(PlantRequest $request, PlantsService $service)
    {
        try {
            $service->create($request);
                
        } catch(\Execetion $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function delete(Request $request, PlantsService $service)
    {
        try {
            $service->delete($request);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true], 200);   
    }

}
