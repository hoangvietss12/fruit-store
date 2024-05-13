<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    private $id;
    private $id_user;

    protected $fillable = [
        'user_id',
    ];
}
