<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    private $id;
    private $name;
    private $email;
    private $phone;
    private $address;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email'
    ];
}
