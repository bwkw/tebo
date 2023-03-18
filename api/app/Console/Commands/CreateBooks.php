<?php

namespace App\Console\Commands;

use App\Application\UseCase\API\CallGoogleBooksApiUseCase;
use Illuminate\Console\Command;

class CreateBooks extends Command
{
    protected $signature = 'books:create {keyword}';
    protected $description = 'Create Book By Api';

    public function __construct(CallGoogleBooksApiUseCase $callGoogleBooksApi)
    {
        parent::__construct();
        $this->callGoogleBooksApi = $callGoogleBooksApi;
    }

    public function handle(): void
    {
        $keyword = $this->argument('keyword');
        $count = 10;
        $this->callGoogleBooksApi->execute($keyword, $count);
    }
}
