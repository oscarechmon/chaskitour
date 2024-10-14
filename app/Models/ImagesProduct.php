<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    use HasFactory;
    protected $table = 'images_product';
    protected $fillable = ['id','product_id','url_image','status'];
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
