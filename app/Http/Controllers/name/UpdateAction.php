<?php

namespace App\Http\Controllers\name;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateAction extends Controller
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'emails' => 'array',
            'emails.*' => 'email',
            'phones' => 'array',
            'phones.*' => 'numeric',
        ]);

        if (!$validator->fails()) {
            $name = Name::find($id);

            if ($name) {
                $name->update([
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'mailing_address' => $request->input('mailing_address'),
                    'photo' => $request->input('photo'),
                ]);

                if ($request->has('emails')) {
                    $name->emails()->delete();
                    foreach ($request->input('emails') as $email) {
                        $name->emails()->create(['email_address' => $email]);
                    }
                } else {
                    $name->emails()->where('name_id', $id)->delete();
                }

                if ($request->has('phones')) {
                    $name->phones()->delete();
                    foreach ($request->input('phones') as $phone) {
                        $name->phones()->create(['phone_number' => $phone]);
                    }
                } else {
                    $name->phones()->where('name_id', $id)->delete();
                }

                return response()->json([
                    "status" => 200,
                    "message" => "Updated successfully"
                ]);
            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "Record not found"
                ]);
            }
        } else {
            return response()->json([
                "status" => 500,
                "message" => "Update failed",
                "error_message" => $validator->errors()
            ]);
        }
    }
}
