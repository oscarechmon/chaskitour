<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Includes extends Model
{
    use HasFactory;
    protected $table = 'includes';  
    protected $fillable = ['product_id','includes','estado','status'];
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
