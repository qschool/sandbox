<?php

namespace QSchool\Sandbox\Sandbox;


/**
 * Class SandboxResult
 * @package QSchool\Sandbox\Sandbox
 */
class SandboxResult
{
    /**
     * @var
     */
    protected $result;
    /**
     * @var
     */
    protected $content;

    /**
     * SandboxResult constructor.
     * @param $result
     * @param $content
     */
    public function __construct($result, $content)
    {
        $this->result = $result;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }

}

