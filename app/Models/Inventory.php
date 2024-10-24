<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Specify the table associated with the model (if different from default)
    protected $table = 'inventories';

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'product_id',
        'quantity',
        'buying_price',
        'selling_price',
    ];

    // Define a relationship to the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Method to increase quantity
    public function addStock(int $quantity, float $buyingPrice, float $sellingPrice)
    {
        $this->quantity += $quantity; // Increase quantity
        $this->buying_price = $buyingPrice; // Update buying price
        $this->selling_price = $sellingPrice; // Update selling price
        $this->save(); // Save the changes
    }

    // Method to reduce quantity
    public function reduceStock(int $quantity)
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity; // Reduce quantity
            $this->save(); // Save the changes
        } else {
            throw new \Exception('Not enough stock available.'); // Handle insufficient stock
        }
    }
}
