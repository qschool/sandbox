<?php

namespace QSchool\Sandbox\Verification;


/**
 * Class Result
 * @package QSchool\Sandbox\Verification
 */
class Result
{
    /**
     * @var int
     */
    protected $points;
    /**
     * @var array
     */
    protected $mistakes;

    /**
     * Result constructor.
     * @param int $points
     * @param array $mistakes
     */
    public function __construct(int $points, array $mistakes)
    {
        $this->points = $points;
        $this->mistakes = $mistakes;
    }

    /**
     * @return int
     */
    public function points()
    {
        return $this->points;
    }

    /**
     * @return array
     */
    public function mistakes()
    {
        return $this->mistakes;
    }

}
