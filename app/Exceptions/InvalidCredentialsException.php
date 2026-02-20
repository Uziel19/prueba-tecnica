<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    private int $statusCode = 401;

    public function __construct()
    {
        parent::__construct("Incorrect username or password.");

    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

}
