<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPayments extends Model
{
    // use HasFactory;
 protected $table = "additional_payments";

 public function new_payment(){
    return $this->hasMany(Payments::class,'id','payment_id');
}

}
