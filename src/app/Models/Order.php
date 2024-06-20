<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UtilityTrait;

class Order extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UtilityTrait;

    protected $table = "orders";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
