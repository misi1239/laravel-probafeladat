<?php

namespace App\Http\Controllers\phoneBook;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;

class ShowAction extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        $phoneBook = Name::with('phones', 'emails')->find($id);

        if (!$phoneBook) {
            return response()->json([
                'error' => 'Nincs ilyen azonosítójú név',
            ], 404);
        }

        return response()->json([
            "phoneBook" => $phoneBook
        ],200);
    }
}
