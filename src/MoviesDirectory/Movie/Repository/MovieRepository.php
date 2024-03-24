<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Repository;

use App\MoviesDirectory\Movie\Core\MovieInterface;

interface MovieRepository
{

    public function add(MovieInterface $movie): void;

    public function findAll(): array;

    public function findByTitleStartsWith(string $term): array;

    public function findByTitleEndsWith(string $term): array;

    public function findByTitleContains(string $term): array;

    public function findByYear(int $year): array;

    public function findByRatingGreaterOrEqual(int $rating): array;

    public function findByRatingLessOrEqual(int $rating): array;

}
