<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => $this->faker->company . '.' . $this->faker->lastName,
            'telp' => '08'.mt_rand(1000000000, 9999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'rekening' => mt_rand(100000000000000, 999999999999999),
            'alamat' => $this->faker->streetAddress .'-' .$this->faker->city .'-'.$this->faker->postcode .'-'.$this->faker->stateAbbr,
        ];
    }
}
