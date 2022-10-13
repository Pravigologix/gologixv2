<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookParkingModel extends Model
{
   // use HasFactory;
   protected $table = "book_parking";

   public function booking_payment_details(){
      return $this->hasMany(Payments::class,'id');
  }
}
