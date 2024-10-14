<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendations extends Model
{
    use HasFactory;
    protected $table = 'recommendations';
    protected $fillable = ['product_id','recommendation','status'];
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
