<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'description' => $this->faker->sentence(rand(10,40)),
            'price' => rand(100,1300),
            'feature_photo' => 'hotel.png',
            'slug' => Str::slug($name),
            'user_id' => User::all()->random()->id,

        ];
    }
}
