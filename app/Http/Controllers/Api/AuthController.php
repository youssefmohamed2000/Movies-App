<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use BaseTrait;

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = auth()->user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;
            return $this->sendResponse($data, 'User Logged in Successfully');
        }
        return $this->sendError('Auth failed', 'this credentials don\'t match our records');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated = array_merge($validated, [
            'password' => Hash::make($validated['password']),
            'type' => 'user'
        ]);

        $user = User::query()->create($validated);
        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;
        return $this->sendResponse($data, 'User Registered Successfully');
    }

    public function user()
    {
        return $this->sendResponse(new UserResource(auth()->user('sanctum')), 'User Sent');
    }
}
