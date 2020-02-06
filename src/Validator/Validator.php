<?php

namespace QSchool\Sandbox\Validator;


use QSchool\Sandbox\Rules\Rule;

/**
 * Class Validator
 * @package QSchool\Sandbox\Validator
 */
class Validator
{
    /**
     * @var Rule
     */
    protected $rule;

    /**
     * Validator constructor.
     * @param Rule $rule
     */
    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @param $code
     * @return bool
     * @throws ValidationException
     */
    public function validate($code): bool
    {
        $this->rule->runValidation($code);
        return true;
    }
}
