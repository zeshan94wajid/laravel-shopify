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
        'city',
        'country',
        'postcode'
    ];
}
