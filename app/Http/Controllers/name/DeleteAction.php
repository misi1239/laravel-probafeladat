<?php

namespace App\Http\Controllers\name;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;

class DeleteAction extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $name = Name::find($id);

        if (!$name) {
            return response()->json([
                'status' => 404,
                'message' => 'Name not found',
            ], 404);
        }

        $name->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Name deleted successfully',
        ]);
    }
}
