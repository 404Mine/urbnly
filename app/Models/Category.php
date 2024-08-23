<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    /**
     * Below shows the relationships between the table for
     * Category Relationships
     * By @404[Mine]
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

}
