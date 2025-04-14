<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Exception;

use Exception;
use Throwable;

/**
 * Base exception for API errors
 */
class ApiException extends Exception
{
    /**
     * @param string $message The error message
     * @param int $code The HTTP status code
     * @param Throwable|null $previous The previous exception
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
