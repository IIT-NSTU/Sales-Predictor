<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'type', 'user_id'];

    // Set Default Value
    protected $attributes = [
        'active' => '1'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}