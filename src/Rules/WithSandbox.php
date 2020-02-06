<?php

namespace QSchool\Sandbox\Rules;


use PHPSandbox\Error;
use PHPSandbox\PHPSandbox;
use QSchool\Sandbox\Sandbox\Sandbox;
use QSchool\Sandbox\Sandbox\SandboxResult;
use QSchool\Sandbox\Validator\ValidationException;

/**
 * Trait WithSandbox
 * @package QSchool\Sandbox\Rules
 */
trait WithSandbox
{
    /** @var Sandbox */
    protected $sandbox;
    
    /** @var array */
    protected $messages = [
        Error::PARSER_ERROR => 'Невозможно выполнить код, синтаксис содержит ошибки',
    ];

    /**
     * @throws Error
     */
    protected function setUp()
    {
        $this->sandbox = new Sandbox();
        $phpSandbox = $this->sandbox->getSandbox();
        $phpSandbox->defineNamespace($phpSandbox->name);
        $this->prepareSandbox($phpSandbox);
    }

    /**
     * @param PHPSandbox $sandbox
     */
    protected function prepareSandbox(PHPSandbox $sandbox)
    {
    }


    /**
     * @param $code
     * @return SandboxResult
     * @throws ValidationException
     */
    protected function runSandbox($code)
    {
        try {
            return $this->sandbox->run($code);
        } catch (Error $exception) {
            
            if (isset($this->messages[$exception->getCode()])) {
                throw new ValidationException($this->messages[$exception->getCode()]);
            }

            throw new ValidationException($exception->getMessage());
        }
    }
    
    public function setMessages(array $messages)
    {
        $this->messages = $messages + $this->messages;
    }
}
