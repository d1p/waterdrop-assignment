<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DogController extends Controller
{
    public function addDog(Request $request)
    {
        return response()->json([
            'message' => 'Dog added successfully',
            'dog' => $request->all()
        ]);
    }

    public function getDogs(Request $request) {
        return response()->json([
            'dogs' => [
                [
                    'name' => 'Fido',
                    'breed' => 'Labrador',
                    'age' => 3
                ],
                [
                    'name' => 'Spot',
                    'breed' => 'Poodle',
                    'age' => 5
                ]
            ]
        ]);
    }
}
