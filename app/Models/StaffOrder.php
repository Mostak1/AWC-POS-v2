<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'staff_id', 'off_order_id', 'point'
    ];
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
   
    public function offorder(){
        return $this->belongsTo(OffOrder::class);
    }
}
