<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'shopify_id',
        'title',
        'type',
    ];

    /**
     * <p> Update product model </p>
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        $this->shopify_id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->type = $attributes['product_type'];

        return $this->save();
    }
}
