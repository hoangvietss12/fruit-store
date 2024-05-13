<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReceivedNoteDetail extends Model
{
    use HasFactory;
    protected $table = 'goods_received_note_details';
    private $id_goods_received_note;
    private $id_product;
    private $quantity;
    private $price;
    private $total;
    private $note;
    protected $fillable = [
        'goods_received_note_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
        'note'
    ];
    public function goods_received_note() {
        return $this->belongsTo(GoodReceivedNote::class, 'goods_received_note_id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
