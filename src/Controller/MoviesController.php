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


        $movies = $this->movieRepository->findAll();

        return $this->render('movies/homepage.html.twig', [
            'movies' => $movies,
            'moviesCount' => count($movies),
        ]);
    }
}
