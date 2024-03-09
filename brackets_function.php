<?php
require_once 'db_connection.php';

function brackets($connection, $string) {
    // Массив, в котором будем хранить открывающие скобки
    $openingBrackets = ['(', '[', '{', '<'];

    // Массив, в котором будем хранить пары скобок
    $bracketPairs = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
        '>' => '<'
    ];

    // Стек для хранения открывающих скобок
    $stack = [];

    $result = 1; // По умолчанию считаем, что скобки правильные

    // Проходим по каждому символу в строке
    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];

        // Если текущий символ - открывающая скобка, добавляем ее в стек
        if (in_array($char, $openingBrackets)) {
            array_push($stack, $char);
        }
        // Если текущий символ - закрывающая скобка
        elseif (array_key_exists($char, $bracketPairs)) {
            // Если стек пуст или последняя открывающая скобка не соответствует текущей закрывающей
            if (empty($stack) || array_pop($stack) !== $bracketPairs[$char]) {
                $result = 0; // Результат проверки скобок (неправильные скобки)
                break; // Прерываем цикл
            }
        }
    }

    // Если после прохода по строке стек не пуст, значит, скобки неправильные
    if (!empty($stack)) {
        $result = 0;
    }

    // Подготовка SQL-запроса
    $expression = $connection->real_escape_string($string);
    $sql = "INSERT INTO expressionsHistory (expression, result) VALUES ('$expression', $result)";

    // Выполнение SQL-запроса
    $connection->query($sql);

    return $result;
}
