<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Responses\Success;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * User authentication.
     *
     * @param LoginRequest $request
     * @return SuccesResponse|Response
     * @api {post} /api/login
     *
     */
    public function store(LoginRequest $request): Success|Response
    {
        if (!Auth::attempt($request->validated())) {
            abort(401, trans('auth.failed'));
        }

        $token = Auth::user()->createToken('auth-token');

        return new Success([
            'token' => $token->plainTextToken,
        ]);
    }
}