<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookParkingModel extends Model
{
   // use HasFactory;
   protected $table = "book_parking";

   public function booking_payment_details(){
      return $this->hasMany(Payments::class,'id','payment_id');
  }

  public function user_details(){
   return $this->hasMany(User::class,'id','user_id');
  }
  public function address_details(){
   return $this->hasMany(AddressModel::class,'id','address_id');
  }

  public function parking_charge_details(){
   return $this->hasMany(ParkingChargeModel::class,'id','parking_charge_id');
  }
  public function all_parking_charge_details(){
   return $this->hasMany(ParkingChargeModel::class,'address_id','address_id');
  }

  public function parking_slot_address_details(){
   return $this->hasMany(ParkingSlotModel::class,'address_id','address_id');
  }

 

 
}
