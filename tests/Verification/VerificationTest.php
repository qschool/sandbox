<?php

namespace Qschool\Sandbox\Tests\Verification;

use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Rules\Rule;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithMethodsCounterAndTwoErrorTask;
use QSchool\Sandbox\Verification\Verification;

/**
 * Class VerificationTest
 * @package Qschool\Sandbox\Tests\Verification
 */
class VerificationTest extends TestCase
{
    /**
     *
     */
    public function test_it_returns_an_empty_verification_results()
    {
        $rule = $this->createMock(Rule::class);
        $verification = new Verification($rule, $maxPoints = 100);
        $code = '';

        $result = $verification->verification($code);

        $this->assertEquals($maxPoints, $result->points());
        $this->assertEquals([], $result->mistakes());
    }

    /**
     *
     */
    public function test_it_runs_rules_to_verify_code_verification()
    {
        $rule = $this->createMock(Rule::class);
        $rule->expects($this->once())->method('runVerification');
        $validator = new Verification($rule);
        $code = '';

        $validator->verification($code);
    }

    /**
     *
     */
    public function test_it_runs_all_tests_to_verify_code_verification_even_if_they_have_errors()
    {
        $rule = new RuleWithMethodsCounterAndTwoErrorTask(5, 10);

        $validator = new Verification($rule, $maxPoints = 100);
        $code = '';

        $result = $validator->verification($code);

        $this->assertEquals($maxPoints - 15, $result->points());
        $this->assertCount(2, $result->mistakes());
    }
    
}
