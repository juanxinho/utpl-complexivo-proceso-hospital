<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'stock_item_id', 'quantity'];

    public function stockItem()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}


