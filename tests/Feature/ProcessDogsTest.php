<?php

namespace Tests\Feature;

use App\Jobs\ProcessDogs;
use Tests\Jobs\Dog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use app\Models\Dog as DogModel;

class ProcessDogsTest extends TestCase
{
    use RefreshDatabase;
    public function test_dogs_are_added_to_the_database(): void
    {
        $dogs = [
            [
                'name' => 'Fido',
                'age' => 3,
                'breed' => 'Labrador',
                'owner' => 'John Smith',
            ],
            [
                'name' => 'Spot',
                'age' => 5,
                'breed' => 'Poodle',
                'owner' => 'Jane Doe',
            ],
        ];

        $job = new ProcessDogs($dogs);
        $dog = new DogModel();
        $job->handle($dog);

        $this->assertDatabaseCount('dogs', 2);
    }
}
