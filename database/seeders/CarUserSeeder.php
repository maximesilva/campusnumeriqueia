<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

class CarUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $users = User::all();
        $cars = Car::all();

        if ($users->isEmpty() || $cars->isEmpty()) {
            return;
        }

        foreach ($cars as $car) {
            $randomUsers = $users->random(random_int(1, 3));
            $car->users()->attach($randomUsers);
        }
    }
}
