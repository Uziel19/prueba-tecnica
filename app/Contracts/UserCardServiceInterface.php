<?php

namespace App\Contracts;

interface UserCardServiceInterface
{
    public function create(int $userId, array $data): array;

}
