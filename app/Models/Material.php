<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'unit', 'quantity', 'price',
    ];
    public function purchase_details(){
        return $this->hasMany(PurchaseDetail::class);
    }
}
