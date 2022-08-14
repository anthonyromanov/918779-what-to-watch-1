<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\Success;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    /**
     * User Logout.
     *
     * @return Success|Response
     * @api {post} /api/login
     *
     */
    public function logout(): Success|Response
    {
        Auth::user()->tokens()->delete();

        return new Success(null, 204);
    }
}