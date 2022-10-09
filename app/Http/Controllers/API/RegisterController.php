<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

use App\Http\Controllers\API\ApiBaseController;
use App\Models\User;

use Validator;


class RegisterController extends ApiBaseController
{


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('api', [])->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponseWithPayload($success, __('User login successfully.'));
        } else {
            return $this->sendError(__('Unauthorised.'), ['error' => __('Unauthorised')], 401);
        }
    }
}
