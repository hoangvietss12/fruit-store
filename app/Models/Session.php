<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    private $id;
    private $id_user;
    private $ip_address;
    private $user_agent;
    private $payload;
    private $last_activity;
    protected $table = 'sessions';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
