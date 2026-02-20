<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    private int $statusCode = 404;


    public function __construct()
    {
        parent::__construct("User does not exist.");
    }


    public function getStatusCode(): int
    {
        return  $this->statusCode;
    }

}
