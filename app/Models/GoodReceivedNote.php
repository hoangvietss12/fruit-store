<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReceivednote extends Model
{
    use HasFactory;
    protected $table = 'goods_received_note';
    private $id;
    private $id_vendor;
    private $total;
    private $date;
    protected $fillable = [
        'vendor_id',
        'total'
    ];
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
