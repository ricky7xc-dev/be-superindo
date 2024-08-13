<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwCartCheckout extends Model
{
    use HasFactory;

    protected $table = 'vw_cart_checkout';
    
    protected $fillable = [
        'user_id', 
        'product_variant_id', 
        'name', 
        'price', 
        'total_quantity', 
        'total_amount', 
        'created_user', 
        'created_date', 
        'updated_user', 
        'updated_date'
    ];
    
    public $timestamps = false;  // Disable Laravel's automatic timestamps
}
