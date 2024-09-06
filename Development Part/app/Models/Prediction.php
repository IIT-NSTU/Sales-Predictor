<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = ['date', 'unit', 'product_id', 'user_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
