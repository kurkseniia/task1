<?php
// Подключение к базе данных
require_once 'db_connection.php';

// Запрос к таблице expressionsHistory
$sql = "SELECT * FROM expressionsHistory ORDER BY expressionID DESC";
$result = $connection->query($sql);

// Если есть результаты
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["expressionID"]. " - Выражение: " . $row["expression"]. " - Результат: " . $row["result"]. "<br>";
    }
} else {
    echo "0 results";
}

// Закрытие результата запроса
$result->close();

// Закрытие соединения с базой данных
$connection->close();

