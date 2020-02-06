<?php

namespace QSchool\Sandbox\Tests\Rules\DummyRules;


use QSchool\Sandbox\Rules\BaseRule;

/**
 * Class RuleWithOneTaskWithError
 * @package QSchool\Sandbox\Tests\Rules\DummyRules
 */
class RuleWithOneTaskWithError extends BaseRule
{
    /**
     * @var int
     */
    protected $points;

    /**
     * RuleWithOneGoodTask constructor.
     * @param $points
     */
    public function __construct(int $points = 10)
    {
        $this->points = $points;
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function test_error_1()
    {
        $this->assertTrue(false, 'Custom Error Text 1', $this->points);
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function validate_error_1()
    {
        $this->assertTrue(false, 'Custom Error Text 2', $this->points);
    }
}
