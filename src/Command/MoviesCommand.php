<?php

declare(strict_types=1);

namespace App\Command;

use App\MoviesDirectory\Movie\Repository\InMemoryMovieRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:movies',
    description: 'List and filter some movies',
    hidden: false
)]
class MoviesCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption(
                'title_starts_with',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that start with this title',
            )

            ->addOption(
                'title_ends_with',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that end with this title',
            )
            ->addOption(
                'title_contains',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that contain this title',
            )
            ->addOption(
                'year',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that contain this year',
            )
            ->addOption(
                'rating_greater_or_equal',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that rating is greater or equal than this',
            )
            ->addOption(
                'rating_less_or_equal',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show only movies that rating is less or equal than this',
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = new InMemoryMovieRepository();

        $options = $input->getOptions();

        $filters = [
            'title_starts_with' => $options['title_starts_with'],
            'title_ends_with' => $options['title_ends_with'],
            'title_contains' => $options['title_contains'],
            'year' => $options['year'],
            'rating_greater_or_equal' => $options['rating_greater_or_equal'],
            'rating_less_or_equal' => $options['rating_less_or_equal'],
        ];

        $oneFilter = array_filter($filters, function ($filter) {
            return $filter !== null;
        });

        if (count($oneFilter) > 1) {
            $output->writeln('Only one filter is allowed');
            return Command::FAILURE;
        }



        switch (array_key_first($oneFilter)) {
            case 'title_starts_with':
                $movies = $repository->findByTitleStartsWith($oneFilter['title_starts_with']);
                $this->printListOfMovies($output, $movies, 'Titles that start with "' . $oneFilter['title_starts_with'] . '"');
                break;
            case 'title_ends_with':
                $movies = $repository->findByTitleEndsWith($oneFilter['title_ends_with']);
                $this->printListOfMovies($output, $movies, 'Titles that end with "' . $oneFilter['title_ends_with'] . '"');
                break;
            case 'title_contains':
                $movies = $repository->findByTitleContains($oneFilter['title_contains']);
                $this->printListOfMovies($output, $movies, 'Titles that contain "' . $oneFilter['title_contains'] . '"');
                break;
            case 'year':
                $movies = $repository->findByYear((int) $oneFilter['year']);
                $this->printListOfMovies($output, $movies, 'Movies from year ' . $oneFilter['year']);
                break;
            case 'rating_greater_or_equal':
                $movies = $repository->findByRatingGreaterOrEqual((int) $oneFilter['rating_greater_or_equal']);
                $this->printListOfMovies($output, $movies, 'Rating greater or equal than ' . $oneFilter['rating_greater_or_equal']);
                break;
            case 'rating_less_or_equal':
                $movies = $repository->findByRatingLessOrEqual((int) $oneFilter['rating_less_or_equal']);
                $this->printListOfMovies($output, $movies, 'Rating less or equal than ' . $oneFilter['rating_less_or_equal']);
                break;
            default:
                $movies = $repository->findAll();
                $this->printListOfMovies($output, $movies, 'All movies');
        }



        return Command::SUCCESS;
    }

    protected function printListOfMovies(OutputInterface $output, array $movies, string $filterMessage = null): void
    {
        $output->writeln([
            '   List of movies (' . count($movies) . ')  ',
            '===================================',
            $filterMessage ?? '',
            '',
        ]);


        foreach ($movies as $movie) {
            $output->writeln('- ' . $movie->getTiTle() . ' (' . $movie->getYear() . ')' . ' - Rating: ' . $movie->getRating());
        }

        $output->writeln('');
        $output->writeln('===================================');
    }
}
