<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Repository;

use App\MoviesDirectory\Movie\Core\MovieInterface;

interface MovieRepository
{

    public function add(MovieInterface $movie): void;

    public function findAll(): array;

    public function findByFilters(array $filters): array;

    public function generate(): void;
}
