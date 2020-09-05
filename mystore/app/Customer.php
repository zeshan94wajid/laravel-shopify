<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'shopify_id',
        'firstname',
        'lastname',
        'email',
        'last_order_id',
        'city',
        'country',
        'postcode'
    ];

    /**
     * <p> Update customer model </p>
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        $this->shopify_id = $attributes['id'];
        $this->firstname = $attributes['first_name'];
        $this->last_name = $attributes['last_name'];
        $this->email = $attributes['email'];
        $this->last_order_id = $attributes['last_order_id'];
        $this->city = $attributes['default_address']['city'];
        $this->country = $attributes['default_address']['country'];
        $this->postcode = $attributes['default_address']['zip'];

        return $this->save();
    }
}
