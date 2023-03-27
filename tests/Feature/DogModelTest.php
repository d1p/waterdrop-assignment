<?php

namespace Tests\Feature;

use App\Models\Dog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DogModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_searchable_array()
    {
        Dog::factory()->create([
            'data' => [
                'name' => 'Fido',
                'age' => 3,
                'breed' => 'Labrador',
            ]
        ]);

        // Check database has a dog named Fido
        $this->assertDatabaseHas('dogs', [
            'data->name' => 'Fido',
        ]);
    }


    public function test_searchable_as()
    {
        $dog = Dog::factory()->create([
            'data' => [
                'name' => 'Fido',
                'age' => 3,
                'breed' => 'Labrador',
            ]
        ]);

        // Check database has a dog named Fido
        $this->assertDatabaseHas('dogs', [
            'data->name' => 'Fido',
        ]);

        // Check the dog is searchable
        $this->assertEquals('dogs_index', $dog->searchableAs());
    }
}
