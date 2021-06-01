<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'age', 'type_id'];

    public function products()
    {
        return $this->hasMany(PlantProtectionProductToPlant::class, 'plant_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(PlantType::class, 'id', 'type_id');
    }

}
