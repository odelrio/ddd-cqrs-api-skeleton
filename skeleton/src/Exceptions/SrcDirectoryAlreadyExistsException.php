<?php declare(strict_types=1);

namespace Skeleton\Exceptions;

use Throwable;

class SrcDirectoryAlreadyExistsException extends \Exception
{
    public function __construct(
        string $message = "\"src\" directory already exists on base directory",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
