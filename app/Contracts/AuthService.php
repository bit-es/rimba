<?php

declare(strict_types=1);

namespace App\Contracts;

interface AuthService
{
    public function authenticate(
        string $login,
        string $password,
        bool $remember
    ): string;
}