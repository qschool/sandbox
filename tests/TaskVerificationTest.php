<?php

namespace Qschool\Sandbox\Tests;

use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Rules\Rule;
use QSchool\Sandbox\TaskVerification;
use QSchool\Sandbox\Validator\Validator;
use QSchool\Sandbox\Verification\Verification;
use QSchool\Sandbox\Verification\Result;

/**
 * Class TaskVerificationTest
 * @package Qschool\Sandbox\Tests
 */
class TaskVerificationTest extends TestCase
{
    /**
     *
     */
    public function test_it_can_be_created_by_a_rule()
    {
        $this->assertInstanceOf(
            TaskVerification::class,
            TaskVerification::createByRule(
                $this->createMock(Rule::class),
                '',
                0
            )
        );
    }

    /**
     *
     */
    public function test_it_can_be_created_by_rules()
    {
        $this->assertInstanceOf(
            TaskVerification::class,
            TaskVerification::createByRules(
                $this->createMock(Rule::class),
                $this->createMock(Rule::class),
                '',
                0
            )
        );
    }

    /**
     * @throws \QSchool\Sandbox\Validator\ValidationException
     */
    public function test_it_returns_the_validator_validation_result()
    {
        $validator = $this->createMock(Validator::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true)
        ;
        
        $verification = $this->createMock(Verification::class);
        
        $taskVerification = new TaskVerification($validator, $verification, '');
        
        
        $this->assertTrue($taskVerification->validate());

        $validator = $this->createMock(Validator::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->willReturn(false)
        ;

        $verification = $this->createMock(Verification::class);
        $taskVerification = new TaskVerification($validator, $verification, '');

        $this->assertFalse($taskVerification->validate());
    }

    /**
     *
     */
    public function test_it_returns_the_verification_verification_results()
    {
        $validator = $this->createMock(Validator::class);
        $verification = $this->createMock(Verification::class);
        $verification
            ->expects($this->once())
            ->method('verification')
            ->willReturn(new Result(0, []))
        ;

        $taskVerification = new TaskVerification($validator, $verification, '');

        $result = $taskVerification->verification();
        
        
        $this->assertEquals(0, $result->points());
        $this->assertEquals([], $result->mistakes());
        
        $verification = $this->createMock(Verification::class);
        $verification
            ->expects($this->once())
            ->method('verification')
            ->willReturn(new Result(125, ['error']))
        ;

        $taskVerification = new TaskVerification($validator, $verification, '');

        $result = $taskVerification->verification();
        
        
        $this->assertEquals(125, $result->points());
        $this->assertEquals(['error'], $result->mistakes());
    }
}
