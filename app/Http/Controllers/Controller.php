<?php

namespace App\Http\Controllers;

use App\Http\Responses\Pagination;
use App\Http\Responses\Success;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    protected function success($data, ?int $code = Response::HTTP_OK): Success
    {
        return new Success($data, $code);
    }

    protected function paginate($data, ?int $code = Response::HTTP_OK): Pagination
    {
        return new Pagination($data, $code);
    }
}
