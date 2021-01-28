<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Article::factory(10)->create();
        \App\Models\Restaurants::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Products::factory(20)->create();
        \App\Models\OrderItem::factory(10)->create();
        \App\Models\Order::factory(5)->create();
        \App\Models\Favorite::factory(10)->create();

        // Order::factory(5)->create()->each(function ($order){
        //     $order->orderItem()->save(OrderItem::factory()->make());
        // });

    }
}
