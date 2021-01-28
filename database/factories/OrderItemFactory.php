<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price'=>$this->faker->numberBetween(100,20000),
            'product_id'=>Products::all()->random()->id,
            'quantity'=>$this->faker->numberBetween(1,20),
        ];
    }
}
