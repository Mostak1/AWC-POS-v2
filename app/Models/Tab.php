<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tab extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'capacity'
    ];
    public function offorders(){
        return $this->hasMany(OffOrder::class);
    }
}
