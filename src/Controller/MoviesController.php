<?php

declare(strict_types=1);

namespace App\Controller;

use App\MoviesDirectory\Movie\Entity\MovieEntity;
use App\MoviesDirectory\Movie\Repository\InMemoryMovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $movieRepository;

    public function __construct(InMemoryMovieRepository $movieRepository)
    {

        $this->movieRepository = $movieRepository;
    }

    #[Route('/movies', name: 'movies_homepage')]
    public function homepage(
        #[MapQueryParameter] ?string $title_starts_with = null,
        #[MapQueryParameter] ?string $title_ends_with = null,
        #[MapQueryParameter] ?string $title_contains = null,
        #[MapQueryParameter] ?int $year = null,
        #[MapQueryParameter] ?int $rating_greater_or_equal = null,
        #[MapQueryParameter] ?int $rating_less_or_equal = null
    ): Response {
        $filters = [
            'title_starts_with' => $title_starts_with,
            'title_ends_with' => $title_ends_with,
            'title_contains' => $title_contains,
            'year' => $year,
            'rating_greater_or_equal' => $rating_greater_or_equal,
            'rating_less_or_equal' => $rating_less_or_equal,
        ];

        $oneFilter = array_filter($filters, function ($filter) {
            return $filter !== null;
        });

        if (count($oneFilter) > 1) {
            $movies = [];
            return $this->render('movies/homepage.html.twig', [
                'movies' => $movies,
                'moviesCount' => count($movies),
                'error' => 'Only one filter at a time can be used.',
            ]);
        }


        switch (array_key_first($oneFilter)) {
            case 'title_starts_with':
                $movies = $this->movieRepository->findByTitleStartsWith($oneFilter['title_starts_with']);
                break;
            case 'title_ends_with':
                $movies = $this->movieRepository->findByTitleEndsWith($oneFilter['title_ends_with']);
                break;
            case 'title_contains':
                $movies = $this->movieRepository->findByTitleContains($oneFilter['title_contains']);
                break;
            case 'year':
                $movies = $this->movieRepository->findByYear($oneFilter['year']);
                break;
            case 'rating_greater_or_equal':
                $movies = $this->movieRepository->findByRatingGreaterOrEqual($oneFilter['rating_greater_or_equal']);
                break;
            case 'rating_less_or_equal':
                $movies = $this->movieRepository->findByRatingLessOrEqual($oneFilter['rating_less_or_equal']);
                break;
            default:
                $movies = $this->movieRepository->findAll();
        }

        return $this->render('movies/homepage.html.twig', [
            'movies' => $movies,
            'moviesCount' => count($movies),
            'error' => null,
        ]);
    }
}
