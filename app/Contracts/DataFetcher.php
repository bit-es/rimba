<?php

declare(strict_types=1);

namespace App\Contracts;

interface DataFetcher
{
    public function fetch(array $config): array;
}
