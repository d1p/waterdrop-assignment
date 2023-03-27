<?php

namespace Tests\Feature;

use App\Models\Dog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_dog()
    {
        $response = $this->json('POST', '/api/adddog',
            [
                ['name' => 'Fido',
                    'age' => 3,
                    'breed' => 'Labrador',]
            ], [
                'Authorization' => 'Bearer ' . env('AUTH_TOKEN'),
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            "message" => "Dog added successfully"
        ]);
    }

    public function test_get_dogs()
    {
        $dog = Dog::factory()->create([
            'data' => [
                'name' => 'Fido',
                'age' => 3,
                'breed' => 'Labrador',
            ]
        ]);

        $response = $this->json('GET','/api/dogs',[] ,[
            'Authorization' => 'Bearer ' . env('AUTH_TOKEN'),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'current_page' => 1,
        ]);
    }
    public function test_add_dog_forbidden()
    {
        $response = $this->json('POST', '/api/adddog',
            [
                ['name' => 'Fido',
                    'age' => 3,
                    'breed' => 'Labrador',]
            ], [
                'Authorization' => 'Bearer asd',
            ]);

        $response->assertStatus(403);
    }

    public function test_get_dogs_forbidden()
    {
        Dog::factory()->create([
            'data' => [
                'name' => 'Fido',
                'age' => 3,
                'breed' => 'Labrador',
            ]
        ]);

        $response = $this->json('GET','/api/dogs',[] ,[
        ]);

        $response->assertStatus(403);
    }
}
