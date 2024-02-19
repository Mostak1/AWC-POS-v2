<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'images', 'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function menus(){
        return $this->hasMany(Menu::class);
    }
}