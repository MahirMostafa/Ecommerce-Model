<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'buying_price',
        'selling_price',
    ];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
