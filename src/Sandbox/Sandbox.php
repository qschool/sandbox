<?php

namespace QSchool\Sandbox\Sandbox;


use PHPSandbox\Error;
use PHPSandbox\PHPSandbox;

/**
 * Class Sandbox
 * @package QSchool\Sandbox\Sandbox
 */
class Sandbox
{
    /**
     * @var PHPSandbox
     */
    protected $sandbox;


    /**
     * Sandbox constructor.
     */
    public function __construct()
    {
        $this->sandbox = new PHPSandbox();
    }

    /**
     * @return PHPSandbox
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @param $code
     * @return SandboxResult
     * @throws Error
     */
    public function run($code)
    {
        ob_start();

        try {
            $result = $this->sandbox->execute($code);
            $content = ob_get_contents();
        } finally {
            ob_end_clean();
        }

        return new SandboxResult($result, $content);
    }

    /**
     * @return string
     */
    public function showGeneratedCode()
    {
        return $this->getSandbox()->getGeneratedCode();
    }
}
