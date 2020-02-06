<?php

use QSchool\Sandbox\Validator\ValidationException;

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once __DIR__ . '/RuleExampleTask.php';

$code = file_get_contents(__DIR__ . '/task.php');
$task = QSchool\Sandbox\TaskVerification::createByRule(new RuleExampleTask(), $code, $maxPoints = 15);

try {

    if ($task->validate()) {

        $verificationResult = $task->verification();
        
        $points = $verificationResult->points();
        $mistakes = $verificationResult->mistakes();

        echo "Ваш результат $points из $maxPoints" . PHP_EOL;
        
        if (empty($mistakes)) {
            echo "Поздравляемы, вы идеально решили задание" . PHP_EOL;
        } else {
            echo "Допущенные ошибки: " . PHP_EOL;
        }
        
        foreach ($mistakes as $mistake) {
            echo  $mistake . PHP_EOL;
        }
        
    }

} catch (ValidationException $exception) {
    $errorMessage = $exception->getMessage();
    echo 'Ошибка проверки кода: ' . $errorMessage . PHP_EOL;
}
