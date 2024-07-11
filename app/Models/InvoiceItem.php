<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'stock_item_id', 'quantity', 'price'];

    public function stockItem()
    {
        return $this->belongsTo(Stock::class);
    }
}
