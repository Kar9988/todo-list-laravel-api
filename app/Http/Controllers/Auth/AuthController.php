<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignInRequest;
use App\Http\Requests\UserSignUpRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(UserSignInRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)
                ->first();
            return response()->json([
                'success' => 1,
                'type'    => 'success',
                'token'   => $user->createToken('auth-token', ['*'], now()->addWeek())->plainTextToken
            ]);
        }
        return response()->json([
            'success' => 0,
            'type'    => 'error'
        ], 404);

    }

    /**
     * @param UserSignUpRequest $request
     * @return JsonResponse
     */
    public function register(UserSignUpRequest $request): JsonResponse
    {
        $user = UserService::create($request->all());
        if ($user) {

            return response()->json([
                'success' => 1,
                'type'    => 'success'
            ], 201);
        }

        return response()->json([
            'success' => 0,
            'type'    => 'error'
        ], 500);
    }

}
