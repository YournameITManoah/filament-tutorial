<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\TimeLog;
use App\Models\User;

class TimeLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeLog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 years');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +8 hours');

        return [
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'start_time' => $start,
            'stop_time' => $end,
            'description' => $this->faker->text(),
        ];
    }
}
