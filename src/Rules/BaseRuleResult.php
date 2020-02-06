<?php

namespace QSchool\Sandbox\Rules;


use QSchool\Sandbox\Validator\ValidationException;

/**
 * Class BaseRuleResult
 * @package QSchool\Sandbox\Rules
 */
class BaseRuleResult
{
    /**
     * @var
     */
    protected $testName;
    /** @var ValidationException|null */
    protected $exception = null;

    /**
     * BaseRuleResult constructor.
     * @param string $testName
     * @param ValidationException|null $exception
     */
    public function __construct(string $testName, ValidationException $exception = null)
    {
        $this->testName = $testName;
        $this->exception = $exception;
    }

    /**
     * @param ValidationException $exception
     */
    public function setException(ValidationException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return bool
     */
    public function isCorrect()
    {
        return ! $this->hasError();
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return null !== $this->exception;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->testName;
    }

    /**
     * @return ValidationException|null
     */
    public function error()
    {
        return $this->exception;
    }

}
