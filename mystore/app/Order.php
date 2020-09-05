<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'shopify_id',
        'total_price',
        'order_date',
        'customer_shopify_id'
    ];

    /**
     * <p> Update order model </p>
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        $this->shopify_id = $attributes['id'];
        $this->total_price = $attributes['total_price'];
        $this->order_date = Carbon::parse($attributes['processed_at'])->format('Y-m-d H:i:s');
        $this->customer_shopify_id = $attributes['customer']['id'];

        return $this->save();
    }
}
