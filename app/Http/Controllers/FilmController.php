<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Bus\Dispatcher;

class FilmController extends Controller
{

    public function __construct(private readonly Dispatcher $dispatcher)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return  JsonResponse|Responsable
     */
    public function index()
    {
        return $this->paginate(Film::select(['id', 'name'])->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddFilmRequest $request): JsonResponse
    {

        $this->dispatcher->dispatch(new AddFilm($request->imdb));

        return $this->success(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return $this->success($film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
