<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Products;
use App\Models\Restaurants;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->title(),
            'restaurant_id'=>Restaurants::all()->random()->id,
            'description'=>$this->faker->text(200),
            'category_id'=>Category::all()->random()->id,
            'price'=>$this->faker->numberBetween(100,20000),
        ];
    }
}
