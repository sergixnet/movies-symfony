<?php

use PHPUnit\Framework\TestCase;
use App\MoviesDirectory\Movie\Entity\MovieEntity;
use App\MoviesDirectory\Movie\Repository\InMemoryMovieRepository;

class InMemoryMovieRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new InMemoryMovieRepository();
        $this->repository->empty();
    }

    public function testAdd()
    {
        $movie = new MovieEntity('Test Movie', 2022, 8);
        $this->repository->add($movie);
        $this->assertCount(1, $this->repository->findAll());
    }

    public function testFindAll()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(2, $this->repository->findAll());
    }

    public function testFindByTitleStartsWith()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('The Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(1, $this->repository->findByTitleStartsWith('Test Movie'));
    }

    public function testFindByTitleEndsWith()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(1, $this->repository->findByTitleEndsWith('Movie 2'));
    }

    public function testFindByTitleContains() {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $movie3 = new MovieEntity('Test Film 3', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->repository->add($movie3);
        $this->assertCount(2, $this->repository->findByTitleContains('Movie'));
    }

    public function testFindByYear()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(1, $this->repository->findByYear(2022));
    }

    public function testFindByRatingGreaterOrEqual()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(1, $this->repository->findByRatingGreaterOrEqual(8));
    }

    public function testFindByRatingLessOrEqual()
    {
        $movie1 = new MovieEntity('Test Movie 1', 2022, 8);
        $movie2 = new MovieEntity('Test Movie 2', 2021, 7);
        $this->repository->add($movie1);
        $this->repository->add($movie2);
        $this->assertCount(1, $this->repository->findByRatingLessOrEqual(7));
    }

}