<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
 
    protected $fillable = ['id', 'category_id','product' , 'tour', 'price_per_person','main_image','main_video', 'itinerary','daily_departures','pool_service','status'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function imagesProduct()
    {
        return $this->hasMany(ImagesProduct::class, 'product_id');
    }
    function recommendation()
    {
        return $this->hasMany(Recommendations::class, 'product_id');
    }
    function include()
    {
        return $this->hasMany(Includes::class, 'product_id');
    }
}
