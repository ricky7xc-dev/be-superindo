<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwInvoice extends Model
{
    use HasFactory;

    protected $table = 'vw_invoice';
    
    protected $fillable = [
        'user_id', 
        'code', 
        'address', 
        'first_name', 
        'last_name', 
        'email', 
        'payment_method', 
        'payment_proof', 
        'phone_number', 
        'status', 
        'total_amount',
        'created_user', 
        'created_date', 
        'updated_user', 
        'updated_date'
    ];
    
    public $timestamps = false;  // Disable Laravel's automatic timestamps
}
