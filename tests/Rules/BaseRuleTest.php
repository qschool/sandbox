<?php

namespace QSchool\Sandbox\Tests\Rules;

use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithMethodsCounterAndTwoErrorTask;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithMethodsCounterAndTwoGoodTask;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithOneGoodTask;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithOneTaskWithError;
use QSchool\Sandbox\Validator\ValidationException;

/**
 * Class BaseRuleTest
 * @package QSchool\Sandbox\Tests\Rules
 */
class BaseRuleTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function test_it_checks_the_code_and_returns_true_if_there_are_no_errors()
    {
        $rule = new RuleWithOneGoodTask();
        
        $result = $rule->run('<?php');
        $this->assertCount(1, $result);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_throws_an_exception_when_the_code_has_an_error()
    {
        $rule = new RuleWithOneTaskWithError();
     
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Custom Error Text 1');
        
        $rule->run('');
    }

    /**
     * @throws ValidationException
     */
    public function test_it_calls_the_tearDown_and_setUp_methods_for_each_test()
    {
        $rule = new RuleWithMethodsCounterAndTwoGoodTask();
             
        $rule->run('');
        
        $this->assertEquals(2, $rule->tearDown);
        $this->assertEquals(2, $rule->setUp);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_falls_on_the_first_error_when_the_stop_on_first_fall_sets_to_true()
    {
        $rule = new RuleWithMethodsCounterAndTwoErrorTask();
             
        $this->expectException(ValidationException::class);
             
        $rule->run('');
        
        $this->assertEquals(1, $rule->tearDown);
        $this->assertEquals(1, $rule->setUp);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_runs_all_tests_even_if_they_have_errors_when_the_stop_on_first_fall_sets_to_false()
    {
        $rule = new RuleWithMethodsCounterAndTwoErrorTask();
             
        $rule->run('', false);
        
        $this->assertEquals(2, $rule->tearDown);
        $this->assertEquals(2, $rule->setUp);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_has_points_in_the_returned_exception()
    {
        $rule = new RuleWithOneTaskWithError(15);
        
        $result = $rule->run('', false);
        
        $this->assertEquals(15, $result[0]->error()->getPoints());
    }
    
}

