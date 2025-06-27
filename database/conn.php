<?php

$hostname = 'localhost';
$database = 'to_do_list_php';
$username = 'postgres';
$password = 'root';

try {
    $pdo = new PDO("pgsql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "
" . $e->getMessage();
}