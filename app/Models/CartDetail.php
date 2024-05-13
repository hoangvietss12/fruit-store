<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    private $id_cart;
    private $id_product;
    private $quantity;
    private $price;
    protected $table = 'cart_details';
    protected $fillable = [
        'cart _id',
        'product_id',
        'quantity',
        'price'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
