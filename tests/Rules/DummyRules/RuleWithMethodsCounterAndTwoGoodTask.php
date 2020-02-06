<?php

namespace QSchool\Sandbox\Tests\Rules\DummyRules;


use QSchool\Sandbox\Rules\BaseRule;

/**
 * Class RuleWithMethodsCounterAndTwoGoodTask
 * @package QSchool\Sandbox\Tests\Rules\DummyRules
 */
class RuleWithMethodsCounterAndTwoGoodTask extends BaseRule
{
    /**
     * @var int
     */
    protected $pointsToError1;
    /**
     * @var int
     */
    protected $pointsToError2;

    /**
     * @var int
     */
    public $tearDown = 0;
    /**
     * @var int
     */
    public $setUp = 0;

    /**
     * RuleWithMethodsCounterAndTwoErrorTask constructor.
     * @param int $pointsToError1
     * @param int $pointsToError2
     */
    public function __construct(int $pointsToError1 = 5, int $pointsToError2 = 10)
    {
        $this->pointsToError1 = $pointsToError1;
        $this->pointsToError2 = $pointsToError2;
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->setUp++;
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->tearDown++;
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function test_ok_1()
    {
        $this->assertTrue(true, 'Custom Error Text 1', $this->pointsToError1);
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function test_ok_2()
    {
        $this->assertTrue(true, 'Custom Error Text 2', $this->pointsToError2);
    }
}
