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
        $time_slot = self::get_time_slot();

        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'income' => $this->faker->numberBetween(700, 5000),
            'requested_amount' => $this->faker->randomElement([100000, 150000, 200000, 250000]),
            'employee_id' => Employee::all()->random()->id,
            'time_slot_start' => $time_slot['time_slot_start'],
            'time_slot_end' => $time_slot['time_slot_end']
        ];
    }

    public function get_time_slot() {

        $max_minute = 24*60;
        $min_minute = 8*60;
        
        $time_slot_end_minutes = rand($min_minute,$max_minute);
        $time_slot_start_minutes = rand($time_slot_end_minutes-$min_minute,$time_slot_end_minutes-60);

        return ['time_slot_start' => $time_slot_start_minutes, 'time_slot_end' => $time_slot_end_minutes];
    }
}
