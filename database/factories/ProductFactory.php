<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'https://cdn.pixabay.com/photo/2014/06/18/18/41/running-shoe-371624_1280.jpg',
            'https://cdn.pixabay.com/photo/2017/09/03/14/41/mock-up-2710535_1280.jpg',
            'https://acdn.mitiendanube.com/stores/001/593/734/products/ng-a100bt-pl-angulo1-8d30f7d17ecc9b8c8e16518679401776-1024-1024.jpg'
        ];
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(4000, 30000),
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'img' => $this->faker->randomElement($images)
        ];
    }
}
