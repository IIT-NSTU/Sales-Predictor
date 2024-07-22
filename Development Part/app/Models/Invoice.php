<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = ['type', 'total', 'discount', 'payable', 'paid', 'initial_due', 'remaining_due', 'date', 'user_id', 'customer_id'];

    function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    function invoice_product(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    function dues(): HasMany
    {
        return $this->hasMany(Due::class);
    }

}