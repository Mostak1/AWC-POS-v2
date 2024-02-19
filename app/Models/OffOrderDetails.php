<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffOrderDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'off_order_id', 'menu_id', 'quantity','total',
    ];
    public function off_order()
    {
        return $this->belongsTo(OffOrder::class);
    }
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    
}
