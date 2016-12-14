<?php
/**
 * PDO数据连接测试
 */
$dsn = "mysql:host=localhost;port=3306;dbname=test";
$pdo = new PDO($dsn, 'root', 'root');
$sql = "SELECT * FROM test1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll();
print_r($res);