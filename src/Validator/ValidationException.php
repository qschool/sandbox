<?php

namespace QSchool\Sandbox\Validator;

use Exception;
use Throwable;

/**
 * Class ValidationException
 * @package QSchool\Sandbox\Validator
 */
class ValidationException extends Exception
{
    /**
     * @var int
     */
    protected $points;

    /**
     * ValidationException constructor.
     * @param string $message
     * @param int $points
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $points = 0, $code = 0, Throwable $previous = null)
    {
        $this->points = $points;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}
