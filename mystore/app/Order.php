<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'shopify_id',
        'total_price',
        'order_date',
        'customer_shopify_id'
    ];
}
