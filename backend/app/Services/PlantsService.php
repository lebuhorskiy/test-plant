<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Plant;
use Exception;
use DB;
class PlantsService {

    public function getAllPlants() 
    {
        return Plant::with(['products.product', 'type'])->orderBy('id', 'DESC')->get();
    }

    public function findById(Request $request) 
    {
        return Plant::where('id', '=', $request->id)->with(['products.product:id', 'type'])->first();
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        $plant = Plant::find($request->id);
        $plant->update([
            'type_id' => $request->type,
            'title' => $request->title,
            'age' => $request->age,
        ]);

        try {
            $plant->products()->delete();
        } catch(Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
        
        foreach($request->products as $product) {
            $plant->products()->create([
                'plant_protection_id' => $product,
                'plant_id' => $plant->id,
            ]);
        }

        DB::commit();

    }

    public function create(Request $request)
    {
        $plant = Plant::create([
            'type_id' => $request->type,
            'title' => $request->title,
            'age' => $request->age,
        ]);

        foreach($request->products as $product) {
            $plant->products()->create([
                'plant_protection_id' => $product,
                'plant_id' => $plant->id,
            ]);
        }
    }


    public function delete(Request $request)
    {
        $plant = Plant::find($request->id);
        if(!$plant) {
            throw new Exception('not found');
        }

        try {
            $plant->delete();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }

}