<?php

namespace App\Exceptions;

use Exception;

class CardAlreadyExistsException extends Exception
{
     private int $statusCode = 422;

    public function __construct()
    {
        parent::__construct("The card number cannot be assigned.");

    }

      public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
