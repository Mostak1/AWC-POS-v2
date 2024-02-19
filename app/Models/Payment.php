<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'order_id', 'cash', 'e_cash', 'method', 'tranjection_number','total'
    ];

    public function off_order(){
        return $this->belongsTo(OffOrder::class,'order_id');
    }
}
