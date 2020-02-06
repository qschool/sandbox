<?php

namespace QSchool\Sandbox\Tests\Rules\DummyRules;


use QSchool\Sandbox\Rules\BaseRule;
use QSchool\Sandbox\Rules\WithSandbox;

/**
 * Class RuleWithSandboxAndOneGoodTask
 * @package QSchool\Sandbox\Tests\Rules\DummyRules
 */
class RuleWithSandboxAndOneGoodTask extends BaseRule
{
    use WithSandbox;

    /**
     * @param $code
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function test_ok($code)
    {
        $this->runSandbox($code);

        $this->assertTrue(true);
    }
}
