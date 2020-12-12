<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'income' => $this->faker->numberBetween(700, 5000),
            'requested_amount' => $this->faker->randomElement([100000, 150000, 200000, 250000]),
            'employee_id' => Employee::all()->random()->id
        ];
    }
}
