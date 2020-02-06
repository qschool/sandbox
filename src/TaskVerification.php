<?php

namespace QSchool\Sandbox;


use QSchool\Sandbox\Rules\Rule;
use QSchool\Sandbox\Validator\Validator;
use QSchool\Sandbox\Validator\ValidationException;
use QSchool\Sandbox\Verification\Verification;
use QSchool\Sandbox\Verification\Result;

/**
 * Class TaskVerification
 * @package QSchool\Sandbox
 */
class TaskVerification
{
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * @var Verification
     */
    protected $verification;
    /**
     * @var string
     */
    protected $code;

    /**
     * TaskVerification constructor.
     * @param Validator $validator
     * @param Verification $verification
     * @param string $code
     */
    public function __construct(Validator $validator, Verification $verification, $code)
    {
        $this->validator = $validator;
        $this->verification = $verification;
        $this->code = $code;
    }

    /**
     * @param Rule $rule
     * @param $code
     * @param $points
     * @return static
     */
    public static function createByRule(Rule $rule, $code, $points)
    {
        return static::createByRules($rule, $rule, $code, $points);
    }

    /**
     * @param Rule $validationRule
     * @param Rule $verificationRule
     * @param $code
     * @param $points
     * @return static
     */
    public static function createByRules(Rule $validationRule, Rule $verificationRule, $code, $points)
    {
        return new static(
            new Validator($validationRule),
            new Verification($verificationRule, $points),
            $code
        );
    }

    /**
     * @return bool
     * @throws ValidationException
     */
    public function validate(): bool
    {
        return $this->validator->validate($this->code);
    }

    /**
     * @return Result
     */
    public function verification(): Result
    {
        return $this->verification->verification($this->code);
    }
}
