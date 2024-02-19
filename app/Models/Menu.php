<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'category_id', 'subcategory_id', 'name','image', 'details', 'price', 'quantity', 'discount', 'active', 'status', 'featured','hot',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function offorders(){
        return $this->hasMany(OffOrderDetails::class);
    }
}
