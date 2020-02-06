<?php

namespace Qschool\Sandbox\Tests;

use PHPUnit\Framework\TestCase;
use QSchool\Sandbox\Sandbox\Sandbox;

/**
 * Class SandboxTest
 * @package Qschool\Sandbox\Tests
 */
class SandboxTest extends TestCase
{
    /**
     * @throws \PHPSandbox\Error
     */
    public function test_its_result_contains_a_result_that_returns_code()
    {
        $sandbox = new Sandbox();
        
        $result = $sandbox->run('return 3;');
        $this->assertEquals(3, $result->result());        
    }

    /**
     * @throws \PHPSandbox\Error
     */
    public function test_its_result_contains_a_content_that_prints_code()
    {
        $sandbox = new Sandbox();
        
        $result = $sandbox->run('echo "Hello";');
        $this->assertEquals('Hello', $result->content());        
    }

    /**
     * @throws \PHPSandbox\Error
     */
    public function test_its_code_can_be_configured()
    {
        $sandbox = new Sandbox();
        $sandbox->getSandbox()->setAppendedCode('echo "123"; return 3;');

        $result = $sandbox->run('');
        $this->assertEquals(3, $result->result());
        $this->assertEquals('123', $result->content());
    }

}
