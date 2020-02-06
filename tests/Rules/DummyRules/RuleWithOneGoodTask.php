<?php

namespace QSchool\Sandbox\Tests\Rules\DummyRules;


use QSchool\Sandbox\Rules\BaseRule;

/**
 * Class RuleWithOneGoodTask
 * @package QSchool\Sandbox\Tests\Rules\DummyRules
 */
class RuleWithOneGoodTask extends BaseRule
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
    public function test_ok()
    {
        $this->assertTrue(true, 'Custom Error Text 1', $this->points);
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function validate_ok()
    {
        $this->assertTrue(true, 'Custom Error Text 2', $this->points);
    }
}
