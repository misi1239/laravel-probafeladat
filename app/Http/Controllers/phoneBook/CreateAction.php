<?php

namespace App\Http\Controllers\phoneBook;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:names,name',
            'emails' => 'required',
            'emails.*' => 'required|email|unique:emails,email_address',
            'phones' => 'nullable|array',
            'phones.*' => 'nullable|numeric|unique:phones,phone_number',
        ]);

        if(!$validator->fails()) {

        $name = "";
            if ($request->has('name') && !empty($request->name)) {
                $name = Name::create([
                    'name' => $request->name,
                    'address' => $request->address,
                    'mailing_address' => $request->mailing_address,
                    'photo' => $request->photo,
                ]);
            }

            if ($request->has('emails') && !empty($request->emails)) {
                foreach ($request->emails as $email) {
                    $name->emails()->create(['email_address' => $email]);
                }
            }

            if ($request->has('phones') && !empty($request->phones)) {
                foreach ($request->phones as $phone) {
                    $name->phones()->create(['phone_number' => $phone]);
                }
            }

            return response()->json([
               "status" => 200,
               "message" => "Created successfully"
            ]);
        } else {
            return response()->json([
                "status" => 500,
                "message" => "Created failed",
                "error_message" => $validator->errors()
            ]);
        }
    }
}
