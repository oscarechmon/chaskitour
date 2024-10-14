<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    use HasFactory;
    protected $table = "brochures";
    protected $fillable = ['url_brochure','status'];
}
