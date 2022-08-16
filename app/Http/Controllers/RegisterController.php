<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Responses\Success;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * Registers a new user.
     *
     * @param UserRequest $request
     * @return Success|Response
     * @api {post} /api/register
     *
     */

    public function store(UserRequest $request): Success|Response
    {
        $params = $request->safe()->except('file');
        $user = User::create($params);
        $token = $user->createToken('auth-token');

        return new Success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }


}