<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use HasFactory;

    protected $fillable = [
        'category_id',
        'sex_id',
        'bodytype_id',
        'store_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];

    public $casts = [
        'images' => 'array',
    ];

    /**
     * Database Relationship for [Product]
     * This is Important
     * By @404[Mine]
     */

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function bodytype() {
        return $this->belongsTo(BodyType::class);
    }

    public function sex() {
        return $this->belongsTo(Sex::class);
    }

    public function orderItem() {
        return $this->hasMany(OrderItem::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

}
