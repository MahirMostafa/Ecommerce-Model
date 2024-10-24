<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pname',
        'description',
        'image',
        'status',
        'category_id',
        'brand_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function getBuyingPriceAttribute()
    {
        return $this->inventory ? $this->inventory->buying_price : null;
    }

    public function getSellingPriceAttribute()
    {
        return $this->inventory ? $this->inventory->selling_price : null;
    }

    public function getQuantityAttribute()
    {
        return $this->inventory ? $this->inventory->quantity : 0;
    }
}
