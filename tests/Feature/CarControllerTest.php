<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_list_of_cars()
    {
        Car::factory()->count(3)->create();

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store_creates_new_car()
    {
        $carData = [
            'make' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2020,
            'color' => 'Red',
            'price' => 15000.00,
        ];

        $response = $this->postJson('/api/cars', $carData);

        $response->assertStatus(201)
                 ->assertJson($carData);

        $this->assertDatabaseHas('cars', $carData);
    }

    public function test_store_fails_validation()
    {
        $invalidData = [
            'make' => '',
            'model' => 'Corolla',
            'year' => 'not_a_number',
            'color' => 'Red',
            'price' => 'not_a_number',
        ];

        $response = $this->postJson('/api/cars', $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['make', 'year', 'price']);
    }

    public function test_show_returns_specific_car()
    {
        $car = Car::factory()->create();

        $response = $this->getJson("/api/cars/{$car->id}");

        $response->assertStatus(200)
                 ->assertJson($car->toArray())
                 ->assertJsonStructure(['users' => []]);
    }

    public function test_show_returns_404_for_nonexistent_car()
    {
        $response = $this->getJson('/api/cars/999');

        $response->assertStatus(404);
    }

    public function test_update_modifies_car()
    {
        $car = Car::factory()->create();
        $updatedData = [
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2021,
            'color' => 'Blue',
            'price' => 16000.00,
        ];

        $response = $this->putJson("/api/cars/{$car->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJson($updatedData);

        $this->assertDatabaseHas('cars', $updatedData);
    }

    public function test_update_returns_404_for_nonexistent_car()
    {
        $updatedData = [
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2021,
            'color' => 'Blue',
            'price' => 16000.00,
        ];

        $response = $this->putJson('/api/cars/999', $updatedData);

        $response->assertStatus(404);
    }

    public function test_destroy_deletes_car()
    {
        $car = Car::factory()->create();

        $response = $this->deleteJson("/api/cars/{$car->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Car deleted successfully']);

        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    public function test_destroy_returns_404_for_nonexistent_car()
    {
        $response = $this->deleteJson('/api/cars/999');

        $response->assertStatus(404);
    }
}
