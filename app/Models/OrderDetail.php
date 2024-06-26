<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    private $id_order;
    private $quantity;
    private $price;
    private $total_price;
    private $id_product;
    protected $fillable = [
        'order _id',
        'product_id',
        'quantity',
        'price',
        'total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
