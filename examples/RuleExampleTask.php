<?php

use PHPSandbox\PHPSandbox;
use QSchool\Sandbox\Rules\BaseRule;
use QSchool\Sandbox\Rules\WithSandbox;

class RuleExampleTask extends BaseRule
{
    use WithSandbox;

    protected function prepareSandbox(PHPSandbox $sandbox)
    {
        $sandbox->setOption('allow_functions', true);
        $sandbox->whitelistFunc(['example_task']);
        $sandbox->whitelistConst(['PHP_EOL']);
    }

    public function validate_empty_code($code)
    {
        $this->assertTrue(! empty(trim($code)), 'Не введен код');
    }

    public function validate_code_syntax($code)
    {
        $this->runSandbox($code);
    }

    public function validate_code_has_function($code)
    {
        $this->sandbox->getSandbox()->setAppendedCode('
            return function_exists(__NAMESPACE__ . "\\\\example_task");
        ');

        $result = $this->runSandbox($code);

        $this->assertTrue($result->result() === true, 'Функция example_task() не найдена');
    }

    public function validate_code_function_return_content($code)
    {
        $this->sandbox->getSandbox()->setAppendedCode('
            return example_task(19);
        ');

        $result = $this->runSandbox($code);

        $this->assertTrue($result->result() !== null, 'Функция ничего не возвращает');
        $this->assertTrue(strlen($result->content()) > 0, 'Функция ничего не выводит');
    }

    public function test_code_function_correctly_counts_result($code)
    {
        $this->sandbox->getSandbox()->setAppendedCode('
            return [
                example_task(1),
                example_task(5),
                example_task(3),
            ];
        ');

        $result = $this->runSandbox($code);

        $this->assertTrue($result->result()[0] === 1, 'Функция неверно считает сумму', 10);
        $this->assertTrue($result->result()[1] === 15, 'Функция неверно считает сумму', 10);
        $this->assertTrue($result->result()[2] === 6, 'Функция неверно считает сумму', 10);
    }

    public function test_code_function_correctly_echoes_result($code)
    {
        $this->sandbox->getSandbox()->setAppendedCode('
            return [
                example_task(1),
                example_task(5),
                example_task(3),
            ];
        ');

        $result = $this->runSandbox($code);

        $content = explode("\n", trim($result->content()));

        $realResults = [
            0, 1, 0, 1, 2, 3, 4, 5, 0, 1, 2, 3,
        ];

        foreach ($content as $key => $item) {
            $this->assertTrue($item == $realResults[$key], 'Функция Выводит некорректный результат', 5);
        }

    }
}
