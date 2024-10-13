<?php
// File: common.php

// Hàm kết nối PDO
function getPDOConnection() {
    $host = 'aws-0-ap-southeast-1.pooler.supabase.com';
    $db = 'postgres';
    $user = 'postgres.lafntozwkzkwwpqzdbkx';
    $pass = 'gUTFjEBRTbT5C6j1';

    $dsn = "pgsql:host=$host;dbname=$db";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}

// Hàm thực hiện truy vấn SELECT và trả về kết quả dưới dạng mảng
function query($sql, $params = []) {
    $pdo = getPDOConnection();
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(); // Trả về tất cả kết quả dưới dạng mảng
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        return [];
    }
}

// Hàm thực hiện các câu lệnh INSERT, UPDATE, DELETE
function execute($sql, $params = []) {
    $pdo = getPDOConnection();
    try {
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params); // Trả về true nếu thực hiện thành công
    } catch (PDOException $e) {
        echo "Execution failed: " . $e->getMessage();
        return false;
    }
}
?>
