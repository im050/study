<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/21
 * Time: 下午4:26
 */
header('Content-Type:text/html; charset=GBK');
date_default_timezone_set('Asia/Shanghai');
//fwrite($file, 'name: ' . iconv('GBK//IGNORE', 'UTF-8', $name) .
// ' Origin Data : ' . urlencode($name) . "\n");
print_r($_SERVER);
parse_str(file_get_contents("php://input"), $content);
print_r($content);
print_r($_POST);

