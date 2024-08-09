<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variant';
    
    protected $fillable = [
        'product_id', 
        'code', 
        'name', 
        'image_location', 
        'qty', 
        'price', 
        'active', 
        'created_user', 
        'created_date', 
        'updated_user', 
        'updated_date'
    ];
    
    public $timestamps = false;  // Disable Laravel's automatic timestamps
}
