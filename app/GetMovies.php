<?

namespace whatwatch;

class GetMovies
{
    public function getMoviesList(RemoteRepository $moviesRepository): array
    {
        $movies = $moviesRepository->getMovies();
        return $movies;
    }
}
