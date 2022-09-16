<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingChargeModel extends Model
{
    use HasFactory;


	protected $table = "parking_charges";


    public function add_praking_desc(){
        return $this->belongsTo(ParkingDescriptionModel::class);
    }
    public function add_praking_slot(){
        return $this->belongsTo(ParkingSlotModel::class);
    }
}
