<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddMoreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Attendance::factory(2)->create();
        $orders = \App\Models\Order::factory(2)->create();
        foreach($orders as $order){
            \App\Models\OrderItem::factory()->create(['order_id'=>$order->id]);
        }
    }
}
