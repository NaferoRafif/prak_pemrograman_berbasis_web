<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('PBW_DB_HOST') ?: '127.0.0.1';
$user = getenv('PBW_DB_USER') ?: 'root';
$pass = getenv('PBW_DB_PASSWORD') ?: '';
$db   = getenv('PBW_DB_NAME') ?: 'db_perpus_pbw';
$port = (int) (getenv('PBW_DB_PORT') ?: 3306);

try {
    $koneksi = new mysqli($host, $user, $pass, $db, $port);
    $koneksi->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit('Koneksi database gagal: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}