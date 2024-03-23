<?php

declare(strict_types=1);

namespace App\Controller;

use App\MoviesDirectory\Movie\Storage\MovieMemoryStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/movies')]
    public function homepage(): Response
    {

        // TODO: check query strings to filter movies

        // TODO: get movies from MovieMemoryStorage with repository pattern


        $movieMemoryStorage = MovieMemoryStorage::getInstance();
        $movies = $movieMemoryStorage->getMovies();

        return $this->render('movies/homepage.html.twig', [
            'movies' => $movies,
        ]);
    }
}
