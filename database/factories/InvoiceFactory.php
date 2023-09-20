<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement([
            "B", "P", "V"
        ]);

        return [
            "customer_id" => Customer::factory(),
            "amount" => fake()->numberBetween(
                100, 20000
            ),
            "status" => $status,
            "billed_date" => fake()->dateTimeThisDecade(),
            "paid_date" => $status === "P" ?
                fake()->dateTimeThisDecade() :
                null
        ];
    }
}
