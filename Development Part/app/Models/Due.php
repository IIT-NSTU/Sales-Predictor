<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    protected $fillable = ['invoice_id', 'user_id', 'customer_id', 'date', 'amount'];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
