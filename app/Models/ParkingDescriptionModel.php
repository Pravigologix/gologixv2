<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingDescriptionModel extends Model
{
    // use HasFactory;
	protected $table = "add_praking_desc";

    public function add_praking_desc(){
        return $this->hasmany(ParkingChargeModel::class);
    }


   

}
