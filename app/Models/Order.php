<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'address',
        'prescription',
        'status',
        'total_price',
        'user_id',
    ];

    
    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'order_medications')
                    ->withPivot('quantity', 'total_price');
                    }
}
