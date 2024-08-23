<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'slug',
        'contact',
        'email',
        'location',
        'image',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Database Relationship for [Store]
     * This is Important
     * By @404Mine
     */
    
     public function customer() {   //having it in plural form affects the insertion into database table for some reason, even tho this is justa function and should have no dependencies towards columns
        return $this->belongsTo(Customer::class);
    }
    
    public function products() {
        return $this->hasMany(Product::class);
    }

}
