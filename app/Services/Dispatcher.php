<?php

namespace App\Services;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Jobs\AddFilm;

final class AddFilmDispatcher implements Dispatcher
{

    public function __construct(AddFilmRequest $request)
    {
        $this->request = $request;
    }

     public function send_queue(string $imdb): mixed
     {

       return AddFilm::dispatch($this->request->imdb);

     }
}
