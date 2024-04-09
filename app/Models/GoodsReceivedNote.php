<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceivednote extends Model
{
    use HasFactory;
    protected $table = 'goods_received_note';
    protected $fillable = [
        'vendor_id',
        'total'
    ];
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
