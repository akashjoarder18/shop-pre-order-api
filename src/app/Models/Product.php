<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = "products";
    protected $guarded = [];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
