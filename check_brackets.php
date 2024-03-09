<?
//Этот файл выполняет функцию обработки AJAX запросов для проверки правильности скобок в выражении
//Подключаем файл с функцией brackets

// Подключение к базе данных
require_once 'db_connection.php';

// Подключение файла с функцией brackets
require_once 'brackets_function.php';

// Проверяем, был ли отправлен GET-запрос с параметром 'expression'
if (isset($_GET['expression'])) {
    // Получаем значение параметра 'expression'
    $expression = $_GET['expression'];

    // Проверяем выражение на правильность скобок с помощью функции brackets
    $result = brackets($connection, $expression);

    // Формируем JSON-ответ
    $response = ['success' => (bool)$result];

    // Отправляем JSON-ответ
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Если параметр 'expression' не был отправлен, возвращаем ошибку
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No expression provided']);
}