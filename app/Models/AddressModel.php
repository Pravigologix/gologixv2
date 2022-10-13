<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AddressModel extends Model
{
    // use HasFactory;
	protected $table = "addresses";

    public function booking_desc(){
        return $this->belongsToMany(BookParkingModel::class);
    }
    public function praking_charge(){
        return $this->hasMany(ParkingChargeModel::class,'address_id')->where('is_active','0');
    }
    public function praking_slot(){
        return $this->hasMany(ParkingSlotModel::class,'address_id')->where('is_active','0');
    }

}
