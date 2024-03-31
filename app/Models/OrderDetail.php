<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order _id',
        'product_id',
        'quantity',
        'price',
        'total_price'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
