<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'medication_id', 'quantity'];

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }
}