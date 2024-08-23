<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'shipping_amount',
        'shipping_method',
        'notes',
    ];

    /**
     * Below shows the relationships between the table for
     * Order Relationships
     * By @404[Mine]
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function orderItem() {
        return $this->hasMany(OrderItem::class);
    }

    public function address() {
        return $this->hasOne(Address::class);
    }
}
