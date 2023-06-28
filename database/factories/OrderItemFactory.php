<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;



class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = \App\Models\Product::inRandomOrder()->first();
        $item = $product->toArray();
        Arr::forget($item, 'tag_id');
        Arr::forget($item, 'extras');
        Arr::forget($item, 'image');
        Arr::forget($item, 'id');
        $item['order_id'] = 10;
        $item['qty'] = mt_rand(5,10);
        return $item;
    }

}
