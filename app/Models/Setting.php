<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'c_name', 'address','logo', 'mobile', 'phone', 'website', 'tax', 'discount',
    ];
}
