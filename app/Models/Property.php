<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    public function region()
    {
        return $this->belongsTo(region::class, 'region_id');
    }
    public function images()
    {
        return $this->hasMany(images::class, 'property_id');
    }
}
