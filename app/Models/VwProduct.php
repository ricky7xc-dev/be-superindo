<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwProduct extends Model
{
    use HasFactory;

    protected $table = 'vw_product';
    
    protected $fillable = [
        'plu', 
        'name', 
        'product_category_id', 
        'category_name', 
        'status_product', 
        'variant_count', 
        'created_user', 
        'created_date', 
        'updated_user', 
        'updated_date'
    ];
    
    public $timestamps = false;  // Disable Laravel's automatic timestamps
}
