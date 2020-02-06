<?php

namespace QSchool\Sandbox\Rules;


use QSchool\Sandbox\Validator\ValidationException;

/**
 * Interface Rule
 * @package QSchool\Sandbox\Rules
 */
interface Rule
{
    /**
     * @param $code
     * @param bool $stopOnFirstFall
     * @return array|BaseRuleResult[]
     * @throws ValidationException
     */
    public function run($code, $stopOnFirstFall = true): array;

    /**
     * @param $code
     * @return array|BaseRuleResult[]
     * @throws ValidationException
     */
    public function runValidation($code): array;

    /**
     * @param $code
     * @return array|BaseRuleResult[]
     */
    public function runVerification($code): array;
}
