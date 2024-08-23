<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;


class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_SELLER = 'Seller';
    const ROLE_CUSTOMER = 'Customer';
    const ROLE_ADMIN = 'Admin';
    

    const ROLES = [
        self::ROLE_SELLER => 'Seller',
        self::ROLE_CUSTOMER => 'Customer',
    ];

    public function isSeller() {
        return $this->role === self::ROLE_SELLER;
    }

    public function isCustomer() {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'contact',
        'address',
        'role',
    ];

    /**
     * Below are things that should be hidden for serialization
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * get the attributes that should be cast.
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * This is Important, This is for table relationships for
     * Customer Relationships
     * By @404Mine
     */

    public function store() {
        return $this->hasMany(Store::class);
    }
}
