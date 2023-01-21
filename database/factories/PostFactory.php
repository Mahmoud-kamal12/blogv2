<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(10),
            'description' => $this->faker->realText(200),
            'content'=> $this->faker->realText(10000),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'image' => $this->faker->imageUrl()
        ];
    }
}
