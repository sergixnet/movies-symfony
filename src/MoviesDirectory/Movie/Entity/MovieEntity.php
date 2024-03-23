<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Entity;

use App\MoviesDirectory\Movie\Core\MovieInterface;

class MovieEntity implements MovieInterface
{
    private string $title;
    private int $year;
    private int $rating;

    public function __construct(
        string $title,
        int $year,
        int $rating
    ) {
        $this->title = $title;
        $this->year = $year;
        $this->rating = $rating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'rating' => $this->rating,
        ];
    }
}
