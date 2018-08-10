<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @param $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        if (! auth()->check()) {
            return $value;
        }

        $currency = auth()->user()->currency;

        return (float) number_format($currency->rate * $value, 2);
    }
}
