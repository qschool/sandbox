<?php

namespace Qschool\Sandbox\Tests\Rules;

use PHPSandbox\Error;
use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithSandboxAndOneGoodTask;
use QSchool\Sandbox\Validator\ValidationException;

/**
 * Class BaseRuleWithSandboxTest
 * @package Qschool\Sandbox\Tests\Rules
 */
class BaseRuleWithSandboxTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function test_it_checks_the_code_and_returns_true_if_there_are_no_errors()
    {
        $rule = new RuleWithSandboxAndOneGoodTask();
        
        $result = $rule->run('<?php');
        $this->assertCount(1, $result);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_throws_an_exception_when_the_code_has_a_syntax_error()
    {
        $rule = new RuleWithSandboxAndOneGoodTask();
     
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Невозможно выполнить код, синтаксис содержит ошибки');
        
        $rule->run('a=3');
    }

    /**
     * @throws ValidationException
     */
    public function test_it_throws_an_exception_when_the_code_has_a_different_type_of_error()
    {
        $rule = new RuleWithSandboxAndOneGoodTask();
     
        $this->expectException(ValidationException::class);
        
        $rule->run('echo PHP_EOL;');
    }


    /**
     * @throws ValidationException
     */
    public function test_it_throws_an_exception_with_custom_message()
    {
        $rule = new RuleWithSandboxAndOneGoodTask();
        $rule->setMessages([Error::PARSER_ERROR => 'custom message']);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('custom message');

        $rule->run('a=3');
    }
}

