<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantProtectionProductToPlant extends Model
{
    use HasFactory;
    protected $fillable = ['plant_id', 'plant_protection_id'];
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function product()
    {
        return $this->hasOne(PlantProtectionProduct::class, 'id', 'plant_protection_id');
    }

}
