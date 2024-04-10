<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'vendor_id',
        'images',
        'description',
        'unit',
        'quantity',
        'price',
        'discount',
        'status'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function updateQuantity($productId, $quantityChange) {
        $product = Product::findOrFail($productId);
        $product->quantity += $quantityChange;
        $product->save();
    }
}
