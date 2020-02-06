<?php

namespace Qschool\Sandbox\Tests\Validator;

use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Rules\Rule;
use QSchool\Sandbox\Tests\Rules\DummyRules\RuleWithOneTaskWithError;
use QSchool\Sandbox\Validator\ValidationException;
use QSchool\Sandbox\Validator\Validator;

/**
 * Class ValidatorTest
 * @package Qschool\Sandbox\Tests\Validator
 */
class ValidatorTest extends TestCase
{
    /**
     * @throws ValidationException
     */
    public function test_it_returns_true_for_empty_rules()
    {
        $rule = $this->createMock(Rule::class);
        $validator = new Validator($rule);
        $code = '';
        
        $this->assertTrue($validator->validate($code));
    }

    /**
     * @throws ValidationException
     */
    public function test_it_returns_false_for_rules_with_errors()
    {
        $rule = new RuleWithOneTaskWithError();
        $validator = new Validator($rule);
        $code = '';
        
        $this->expectException(ValidationException::class);
        
        $validator->validate($code);
    }

    /**
     * @throws ValidationException
     */
    public function test_it_runs_rules_to_test_the_code()
    {
        $rule = $this->createMock(Rule::class);
        $rule
            ->expects($this->once())
            ->method('runValidation')
        ;
        $validator = new Validator($rule);
        $code = '';

        $this->assertTrue($validator->validate($code));
    }
}
