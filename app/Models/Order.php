<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
