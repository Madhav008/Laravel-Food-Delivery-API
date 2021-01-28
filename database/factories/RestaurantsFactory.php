<?php

namespace Database\Factories;

use App\Models\Restaurants;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurants::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'name'=>$this->faker->title(),
            'description'=>$this->faker->text(200)
        ];
    }
}
