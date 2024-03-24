<?php

declare(strict_types=1);

namespace App\Controller;

use App\MoviesDirectory\Movie\Entity\MovieEntity;
use App\MoviesDirectory\Movie\Repository\InMemoryMovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $movieRepository;

    public function __construct(InMemoryMovieRepository $movieRepository)
    {

        $this->movieRepository = $movieRepository;
    }

    #[Route('/movies')]
    public function homepage(): Response
    {

        // TODO: check query strings to filter movies
        // Allow only one query parameter to filter movies
        // switch statement form valid query strings



        // $movies = $this->movieRepository->findAll();
        // $movies = $this->movieRepository->findByTitleStartsWith('The');
        // $movies = $this->movieRepository->findByTitleEndsWith('s');
        // $movies = $this->movieRepository->findByTitleContains('Ring');
        $movies = $this->movieRepository->findByYear(1994);
        // $movies = $this->movieRepository->findByRatingGreaterOrEqual(9);
        // $movies = $this->movieRepository->findByRatingLessOrEqual(7);

        return $this->render('movies/homepage.html.twig', [
            'movies' => $movies,
            'moviesCount' => count($movies),
        ]);
    }
}
