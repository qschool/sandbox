<?php

namespace QSchool\Sandbox\Rules;


use QSchool\Sandbox\Validator\ValidationException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * Class BaseRule
 * @package QSchool\Sandbox\Rules
 */
class BaseRule implements Rule
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @param $code
     * @return array|BaseRuleResult[]
     * @throws ValidationException
     */
    public function runValidation($code): array
    {
        return $this->run($code, true, 'validate');
    }

    /**
     * @param $code
     * @return array|BaseRuleResult[]
     * @throws ValidationException
     */
    public function runVerification($code): array
    {
        return $this->run($code, false, 'test');
    }

    /**
     * @param $code
     * @param bool $stopOnFirstFall
     * @param string $methodsPrefix
     * @return array|BaseRuleResult[]
     * @throws ValidationException
     */
    public function run($code, $stopOnFirstFall = true, $methodsPrefix = 'test'): array
    {
        try {
            $methods = $this->getRuleMethodsList();
        } catch (ReflectionException $exception) {
            return [];
        }

        $result = [];

        foreach ($methods as $method) {
            if (strpos($method->name, $methodsPrefix) === 0) {
                $this->setUp();

                $testResult = new BaseRuleResult($method->name);

                try {
                    $this->{$method->name}($code);
                } catch (ValidationException $exception) {
                    $testResult->setException($exception);
                    if ($stopOnFirstFall) {
                        throw $exception;
                    }
                }

                $this->tearDown();

                $result[] = $testResult;
            }
        }

        return $result;
    }

    /**
     * @param $condition
     * @param string $message
     * @param int $points
     * @throws ValidationException
     */
    protected function assertTrue($condition, $message = '', $points = 0)
    {
        if (! $condition) {
            throw new ValidationException($message ?: 'Возникла ошибка при проверке кода', $points);
        }
    }

    /**
     * @return ReflectionMethod[]
     * @throws ReflectionException
     */
    protected function getRuleMethodsList()
    {
        $class = new ReflectionClass(static::class);
        return $class->getMethods(ReflectionMethod::IS_PUBLIC);
    }
}
