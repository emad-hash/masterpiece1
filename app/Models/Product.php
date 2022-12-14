<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id'); 
    }

    public function subcategories(){
        return $this->hasMany(Subcategory::class,'subcategory_id');
    }
}
