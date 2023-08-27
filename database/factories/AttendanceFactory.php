<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = \App\Models\User::inRandomOrder()->first()->id;
        return [
            'check_in_at'          => fake()->time(),
            'check_in_position'    => [    
                mt_rand(16.783330003319925,16.783330004319925),
                mt_rand(96.17429568659355,96.17429568659455)
            ],
            'check_out_at'         => fake()->time(),
            'check_out_position'   => [    
                mt_rand(16.783330003319925,16.783330004319925),
                mt_rand(96.17429568659355,96.17429568659455)
            ],
            'employee_id'          =>  $id,
        ];
    }

}
