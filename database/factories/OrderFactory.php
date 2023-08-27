<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = \App\Models\User::inRandomOrder()->first()->id;
        $id2 = \App\Models\User::inRandomOrder()->first()->id;
        return [
            'sale_person_id'    => $id,
            'shop_owner_id'     => $id2,
            'status'            => 'created',
        ];
    }

}
