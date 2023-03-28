<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDogs;
use App\Models\Dog;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class DogController extends Controller
{
    use DispatchesJobs;

    public function addDog(Request $request)
    {
        # load the json data from the request
        $dogs = $request->json()->all();
        if (!$this->validate_dog_has_name($dogs)) {
            return response()->json([
                'message' => 'Dog must have a name'
            ], 400);
        }

        // dispatch the job to process the data
        $this->dispatch(new ProcessDogs($dogs))->delay(now()->addSeconds(10));

        return response()->json([
            'message' => 'Dog added successfully'
        ]);
    }

    public function getDogs(Request $request)
    {
        // take the search query from the request
        $search_query = $request->query('name');

        try {
            $dogs = Dog::search($search_query)->paginate(30);
        } catch (\Meilisearch\Exceptions\ApiException) {
            logger("There is no index for dogs yet. Creating one using meilisearch dashboard or create a new dog to create one.");
            return response()->json(["message" => "No meilisearch index created yet."], 500);
        }
        return response()->json(
            $dogs
        );
    }

    private function validate_dog_has_name($dogs): bool
    {
        foreach ($dogs as $dog) {
            if (!isset($dog['name'])) {
                return false;
            }
        }
        return true;
    }
}
