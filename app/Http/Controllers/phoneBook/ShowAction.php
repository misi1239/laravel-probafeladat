<?php

namespace App\Http\Controllers\phoneBook;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;

class ShowAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        $phoneBook = Name::with('phones', 'emails')->get();

        return response()->json([
            "phoneBook" => $phoneBook
        ],200);
    }
}
