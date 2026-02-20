<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    private int $statusCode = 422;

    public function __construct()
    {
        parent::__construct("The username is not available.");

    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }




}
