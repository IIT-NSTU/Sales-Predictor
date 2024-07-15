<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'unit', 'img_url', 'category_id', 'user_id', 'details_url'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}