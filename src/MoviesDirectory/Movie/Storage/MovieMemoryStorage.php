<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Storage;

use App\MoviesDirectory\Movie\Entity\MovieEntity;
use App\MoviesDirectory\Movie\Core\MovieInterface;

/**
 * Class MovieMemoryStorage
 *
 * @package App\MoviesDirectory\Movie\Storage
 */
class MovieMemoryStorage
{
    /**
     * @var MovieMemoryStorage
     */
    private static $instance;

    /**
     * @var array
     */
    private $movies = [];

    /**
     * MovieMemoryStorage constructor.
     */
    private function __construct()
    {
        $this->generate();
    }

    /**
     * @return MovieMemoryStorage
     */
    public static function getInstance(): MovieMemoryStorage
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param MovieInterface $movie
     *
     * @return void
     */
    public function addMovie(MovieInterface $movie): void
    {
        $this->movies[] = $movie;
    }

    /**
     * @return array
     */
    public function getMovies(): array
    {
        return $this->movies;
    }

    private function generate(): void
    {
        if (count($this->movies) > 0) {
            return;
        }

        $moviesData = [
            [
                'title' => 'Movie 1',
                'year' => 2020,
                'rating' => 5,
            ],
            [
                'title' => 'Movie 2',
                'year' => 2021,
                'rating' => 4,
            ],
            [
                'title' => 'Movie 3',
                'year' => 2022,
                'rating' => 3,
            ],

        ];

        foreach ($moviesData as $movieData) {
            $movie = new MovieEntity($movieData['title'], $movieData['year'], $movieData['rating']);
            $this->addMovie($movie);
        }
    }
}
