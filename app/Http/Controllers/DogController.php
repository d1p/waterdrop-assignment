<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function addDog(Request $request)
    {
        # load the json data from the request
        $dogs = $request->json()->all();
        if (!$this->validate_dog_has_name($dogs)) {
            return response()->json([
                'message' => 'Dog must have a name'
            ], 400);
        }

        // insert the data into the database
        $formatted_data = [];
        foreach ($dogs as $dog) {
            $formatted_data[] = [
                'data' => json_encode($dog),
                'created_at' => now(),
            ];
        }

        Dog::insert($formatted_data);

        return response()->json([
            'message' => 'Dog added successfully',
            'dog' => $dogs
        ]);
    }

    public function getDogs(Request $request)
    {
        // take the search query from the request
        $search_query = $request->query('search');
        $dogs = Dog::search($search_query)->paginate(30);
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
