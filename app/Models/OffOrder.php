<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delivery_discount','delivery_charge','tab_id','total','user_id','discount','reason','active'
    ];

    public function offorderdetails()
    {
        return $this->hasMany(OffOrderDetails::class);
    }
    public function tab(){
        return $this->belongsTo(Tab::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class,'order_id');
    }
}
