<?php


namespace App\Library\Exceptions;


use Throwable;

class ExchangeFetchException extends \Exception
{
    public function __construct($message = "Failed fetch exchange rates", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
