<?php

namespace App\Exceptions;

use Exception;

class UserDeletionNotAllowedException extends Exception
{
     private int $statusCode = 403;

     public function __construct(){

        parent::__construct("Deleting this user is not allowed.");

     }

     public function getStatusCode(): int
     {
        return $this->statusCode;
     }
}
