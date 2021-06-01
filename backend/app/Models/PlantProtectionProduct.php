<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantProtectionProduct extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'dose'];

    
}
