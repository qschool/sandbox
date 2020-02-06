## Библиотека для создания автоматических тестов для задач
Библиотека для автоматической проверка php заданий, присланных пользователем, с возможностью предварительной валидации и расчетом числа набранных баллов.

Использует библиотеку для запуска php-кода в безопасном окружении: [corveda/php-sandbox](https://github.com/Corveda/PHPSandbox)

## Установка
Для установки просто добавляем зависимость в composer
```
composer require qschool/sandbox
```

#### Demo пример
Создаем новый класс с правилами
```php
use QSchool\Sandbox\Rules\BaseRule;

class TaskRule extends BaseRule
{
    public function validate_code_has_a_var($code)
    {
        $this->assertTrue(strpos('$a', $code) === false, 'В вашем коде не объявлена переменная $a');
    }

    public function test_example_code($code)
    {
        $this->assertTrue(strpos('<br>', $code) === false, 'Код содержит <br> вместо PHP_EOL', 3);
    }
}
```

Инициализируем валидатор, и проверяем задачу
```php
$task = QSchool\Sandbox\TaskVerification::createByRule(new TaskRule(), $code, $maxPoints = 15);
```

Валидируем код на корректности, а затем проверяем задачи, при необходимости получаем ошибки и количество набранных баллов
```php
try {

    if ($task->validate()) {
        // Валдиация кода прошла успешно


        $verificationResult = $task->verification();
        // баллов набрано: $points = $verificationResult->points();
        // допущенные ошибки: $mistakes = $verificationResult->mistakes();
    }

} catch (QSchool\Sandbox\Validator\ValidationException $exception) {
    // Ошибка валидации
}
```
## Использование
Правила удобно наследовать от `QSchool\Sandbox\Rules\BaseRule` класса, тогда в этих классах нужно описать методы для запуска теста

#### Класс Правила
 - Методы с префиксом `validate` - это методы для предварительной валидации задачи
 - Методы с префиксом `test` - для проверки (оценки) самого кода
 - Метод проверки `assertTrue($condition, $errorMessage, $points)` - проверяет услоивие `$condition`, если оно ложно - то выбрасывается исключение `ValidationException`, текст этого исключения можно задать в параметре `$errorMessage`, количество теряемых баллов в параметре `$points`

#### Трейт WithSandbox
 - Предоставляет метод `prepareSandbox` для конфигурации окружения phpSandbox
 - Каждому запускаемому окружению добавляется свой уникальный namespace (см. `setUp`), для возможности запуска одного кода несколько раз
 - Метод `setMessages` - позволяет устновить свой текст для сообщений ошибок phpSandbox, либо, вы можете переопределить все свойство `$messages`
 

## Пример
Пример использования находится в директории `example`, Просто меняйте содержимое examples/task.php и смотрите на результат работы
```
cd example
php index.php
```
