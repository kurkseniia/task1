<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "brackets";

// Создаем соединение с базой данных
$connection = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


