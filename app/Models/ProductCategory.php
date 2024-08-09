<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    
    protected $fillable = [
        'name', 
        'active', 
        'created_user', 
        'created_date', 
        'updated_user', 
        'updated_date'
    ];
    
    public $timestamps = false;  // Disable Laravel's automatic timestamps
}
