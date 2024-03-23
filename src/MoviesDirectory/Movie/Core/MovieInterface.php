<?php

declare(strict_types=1);

namespace App\MoviesDirectory\Movie\Core;

/**
 * Interface MovieInterface
 *
 * @package App\MoviesDirectory\Movie\Core
 */
interface MovieInterface
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return int
     */
    public function getYear(): int;

    /**
     * @return int
     */
    public function getRating(): int;

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void;

    /**
     * @param int $year
     *
     * @return void
     */
    public function setYear(int $year): void;

    /**
     * @param int $rating
     *
     * @return void
     */
    public function setRating(int $rating): void;

    /**
     * @return array
     */
    public function toArray(): array;
}
