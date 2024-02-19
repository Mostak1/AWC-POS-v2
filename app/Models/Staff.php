<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'employeeId','total_order','total_point'
    ];
 
    public function stafforders(){
        return $this->hasMany(StaffOrder::class);
    }
}
