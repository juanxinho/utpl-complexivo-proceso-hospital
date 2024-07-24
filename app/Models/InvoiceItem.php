<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'stock_item_id', 'quantity', 'price'];

    /**
     * Get the stock item that belongs to the invoice item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockItem()
    {
        return $this->belongsTo(Stock::class);
    }
}
