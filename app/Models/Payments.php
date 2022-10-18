<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    // use HasFactory;
    protected $table = "payments";

    public function book_payment(){
        return $this->belongsTo(BookParkingModel::class);
    }
    public function new_addtional_payment(){
        return $this->belongsTo(NewPayments::class);
    }
}
