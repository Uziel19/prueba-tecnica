<?php

namespace App\Contracts;

interface ConsentLogServiceInterface
{
  public function create(int $userId, int $type, string $consentId, bool $status, string $action): void;

}
