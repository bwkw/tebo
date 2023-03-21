<?php

namespace App\Providers;

use App\Application\QueryServiceInterface\BibliographyQueryServiceInterface;
use App\Domain\Author\AuthorRepositoryInterface;
use App\Domain\AuthorBook\AuthorBookRepositoryInterface;
use App\Domain\Book\BookRepositoryInterface;
use App\Domain\Publisher\PublisherRepositoryInterface;
use App\Infrastructure\QueryService\BibliographyQueryService;
use App\Infrastructure\Repository\RDB\AuthorBookRepository;
use App\Infrastructure\Repository\RDB\AuthorRepository;
use App\Infrastructure\Repository\RDB\BookRepository;
use App\Infrastructure\Repository\RDB\PublisherRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            AuthorRepositoryInterface::class,
            AuthorRepository::class
        );
        $this->app->bind(
            AuthorBookRepositoryInterface::class,
            AuthorBookRepository::class
        );
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );
        $this->app->bind(
            PublisherRepositoryInterface::class,
            PublisherRepository::class
        );
        $this->app->bind(
            BibliographyQueryServiceInterface::class,
            BibliographyQueryService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
