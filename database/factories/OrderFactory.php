<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = date('Ymd');

        return [
            'order_no' => $this->faker->unique()->numerify('ORD-#####'),
            'customer_name' => $this->faker->name(),
            'order_date' => now(),
            'grand_total' => $this->faker->randomFloat(2, 20, 5000),
            'created_at' => now(),
        ];
    }
}
