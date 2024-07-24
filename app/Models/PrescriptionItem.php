<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prescription_id', 'stock_item_id', 'quantity'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the stock item associated with the prescription item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockItem()
    {
        return $this->belongsTo(Stock::class, 'stock_item_id', 'id');
    }
}
