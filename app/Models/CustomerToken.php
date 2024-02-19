<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerToken extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'order_id', 'mobile'
    ];

    public function off_order(){
        return $this->belongsTo(OffOrder::class,'order_id');
    }
}
