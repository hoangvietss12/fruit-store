<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    private $id;
    private $id_vendor;
    private $id_category;
    private $name;
    private $description;
    private $images;
    private $unit;
    private $quantity;
    private $status;
    private $price;
    private $discount;
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
    public function goodsReceivedNoteDetails(){
        return $this->hasMany(GoodReceivedNoteDetail::class);
    }
    // Product.php
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    // public function updateQuantity($quantityChange) {
    //     if($this->quantity == 0) {
    //         $this->status = 'Còn hàng';
    //     }

    //     $this->quantity += floatval($quantityChange);
    //     $this->save();
    // }
}
