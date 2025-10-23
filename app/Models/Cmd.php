<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cmd extends Model
{
    const STATUS_PENDING = 'En attente';
    const STATUS_APPROVED = 'Validé';
    const STATUS_REJECTED = 'Refusé';
    protected $table = 'cmd'; 

    protected $fillable = [
        'customer_name', 
        'address', 
        'phone', 
        'prescription', 
        'medications', 
        'total_price', 
        'status'
    ];

    protected $casts = [
        'medications' => 'array',
    ];
}