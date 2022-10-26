<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSlotModel extends Model
{
    // use HasFactory;
	protected $table = "add_praking_slots";
    public function add_praking_slot(){
        return $this->hasMany(ParkingChargeModel::class);
    }

    public function add_park_desc(){
        return $this->belongsToMany(AddressModel::class);
    }

}
