<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'item_name', 'quantity', 'price'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}


