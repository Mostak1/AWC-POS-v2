<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'purchase_id', 'material_id', 'quantity',
    ];

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
