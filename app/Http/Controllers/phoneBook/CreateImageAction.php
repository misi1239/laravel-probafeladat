<?php

namespace App\Http\Controllers\phoneBook;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CreateImageAction
{
    public function __invoke(Request $request): Response
    {

        $imageName = $request->image_path->getClientOriginalName();
        $request->image_path->move(public_path('images'), $imageName);

        return response()->noContent();
    }
}
