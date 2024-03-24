<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Repository;

use App\MoviesDirectory\Movie\Core\MovieInterface;
use App\MoviesDirectory\Movie\Entity\MovieEntity;

class InMemoryMovieRepository implements MovieRepository
{
    private $movies = [];

    public function __construct()
    {
        if (count($this->movies) === 0) {
            $this->generate();
        }
    }


    public function add(MovieInterface $movie): void
    {
        $this->movies[] = $movie;
    }

    public function findAll(): array
    {
        return $this->movies;
    }

    public function findByFilters(array $filters): array
    {
        // TODO: implement filters
        return [];
    }

    public function generate(): void
    {

        $moviesData = [
            [
                'title' => 'The Shawshank Redemption',
                'year' => 1994,
                'rating' => 9,
            ],
            [
                'title' => 'The Godfather',
                'year' => 1972,
                'rating' => 9,
            ],
            [
                'title' => 'The Dark Knight',
                'year' => 2008,
                'rating' => 9,
            ],
            [
                'title' => 'Schindler\'s List',
                'year' => 1993,
                'rating' => 8,
            ],
            [
                'title' => 'The Lord of the Rings: The Return of the King',
                'year' => 2003,
                'rating' => 8,
            ],
            [
                'title' => 'Pulp Fiction',
                'year' => 1994,
                'rating' => 9,
            ],
            [
                'title' => 'Fight Club',
                'year' => 1999,
                'rating' => 8,
            ],
            [
                'title' => 'Forrest Gump',
                'year' => 1994,
                'rating' => 8,
            ],
            [
                'title' => 'Inception',
                'year' => 2010,
                'rating' => 8,
            ],
            [
                'title' => 'The Matrix',
                'year' => 1999,
                'rating' => 8,
            ],
            [
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'year' => 2001,
                'rating' => 8,
            ],
            [
                'title' => 'The Silence of the Lambs',
                'year' => 1991,
                'rating' => 8,
            ],
            [
                'title' => 'Se7en',
                'year' => 1995,
                'rating' => 8,
            ],
            [
                'title' => 'The Usual Suspects',
                'year' => 1995,
                'rating' => 8,
            ],
            [
                'title' => 'Goodfellas',
                'year' => 1990,
                'rating' => 8,
            ],
            [
                'title' => 'Léon: The Professional',
                'year' => 1994,
                'rating' => 8,
            ],
            [
                'title' => 'Saving Private Ryan',
                'year' => 1998,
                'rating' => 8,
            ],
            [
                'title' => 'The Green Mile',
                'year' => 1999,
                'rating' => 8,
            ],
            [
                'title' => 'The Pianist',
                'year' => 2002,
                'rating' => 8,
            ],
            [
                'title' => 'Gladiator',
                'year' => 2000,
                'rating' => 8,
            ],
        ];

        foreach ($moviesData as $movieData) {
            $movie = new MovieEntity($movieData['title'], $movieData['year'], $movieData['rating']);
            $this->add($movie);
        }
    }
}
