<?php

function getDBConnection(): mysqli {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'toothy_treats_db';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}

function closeDBConnection(?mysqli $conn): void {
    if ($conn) {
        $conn->close();
    }
}
