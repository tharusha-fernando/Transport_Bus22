<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\BusStation;
use App\Models\Route;
use App\Models\TimeTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $timetable=TimeTable::all();
        $bus=Bus::all();
        $route=Route::all();
        $busstation=BusStation::all();

        return [
            'time_table_id' =>$timetable->random(), // Define the foreign key value for the time_table_id,
            'bus_id' =>$bus->random(), // Define the foreign key value for the bus_id,
            'type' => fake()->randomElement(['Type A', 'Type B', 'Type C']),
            'details' => fake()->sentence,
            'location_id' => null,
            'start' => fake()->time('H:i:s'),
            'end' => fake()->time('H:i:s'),
            'route_id' => $route->random(),// Define the foreign key value for the route_id,
            'distance' => fake()->randomFloat(2, 1, 100),
            'status' => fake()->randomElement(['scheduled', 'in progress', 'completed']),
            'from' => $busstation->random(), // Define the foreign key value for the 'from' column,
            'to' => $busstation->random(), // Define the foreign key value for the 'to' column,
            'day'=>'Thursday',
            
            //
        ];
    }
}
