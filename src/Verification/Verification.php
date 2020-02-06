<?php

namespace QSchool\Sandbox\Verification;


use QSchool\Sandbox\Rules\Rule;

/**
 * Class Verification
 * @package QSchool\Sandbox\Verification
 */
class Verification
{
    /**
     * @var Rule
     */
    protected $rule;
    /**
     * @var int
     */
    protected $maxPoints;

    /**
     * Verification constructor.
     * @param Rule $rule
     * @param int $maxPoints
     */
    public function __construct(Rule $rule, int $maxPoints = 0)
    {
        $this->rule = $rule;
        $this->maxPoints = $maxPoints;
    }

    /**
     * @param $code
     * @return Result
     */
    public function verification($code): Result
    {
        $result = $this->rule->runVerification($code);

        $pointsResult = $this->maxPoints;
        $errors = [];
        foreach ($result as $item) {
            if ($item->isCorrect()) {
                continue;
            }

            $pointsResult -= $item->error()->getPoints();
            $errors[$item->name()] = $item->error()->getMessage();
        }

        return new Result(max($pointsResult, 0), $errors);
    }
}
