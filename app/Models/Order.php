<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'city',
        'address',
        'total_amount',
        'payment_method',
        'status',
        'order_date',
        'order_number',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Relation to Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
