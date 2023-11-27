<?php

namespace App\Http\Controllers\phoneBook;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateAction extends Controller
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes', 'nullable', Rule::unique('names', 'name')->ignore($request->id)],
            'emails' => 'required',
            'emails.*' => [
                'sometimes',
                'required',
                'email',
                function ($attribute, $value, $fail) use ($request) {
                    $existingEmails = DB::table('emails')
                        ->where('id', '!=', $request->id)
                        ->pluck('email_address')
                        ->toArray();

                    if (count(array_diff($request->input('emails'), $existingEmails)) > 1 && in_array($value, $existingEmails)) {
                        $fail('Ez az email cím már létezik az adatbázisban.');
                    }
                },
            ],
            'phones.*' => [
                'sometimes',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    $existingPhones = DB::table('phones')
                        ->where('id', '!=', $request->id)
                        ->pluck('phone_number')
                        ->toArray();

                    if (count(array_diff($request->input('phones'), $existingPhones)) > 1 && in_array($value, $existingPhones)) {
                        $fail('Ez a telefonszám már létezik az adatbázisban.');
                    }
                },
            ],
        ]);
        if (!$validator->fails()) {
            $name = Name::find($id);

            if ($name) {
                $name->update([
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'mailing_address' => $request->input('mailing_address'),
                    'image_path' => $request->input('image_path'),
                ]);

                if ($request->has('emails')) {
                    $name->emails()->delete();
                    foreach ($request->input('emails') as $email) {
                        if (!empty($email)) {
                            $name->emails()->create(['email_address' => $email]);
                        }
                    }
                } else {
                    $name->emails()->where('name_id', $id)->delete();
                }

                if ($request->has('phones')) {
                    $name->phones()->delete();
                    foreach ($request->input('phones') as $phone) {
                        if (!empty($phone)) {
                            $name->phones()->create(['phone_number' => $phone]);
                        }
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
