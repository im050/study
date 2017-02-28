<?php
include 'core.php';

$action = isset($_GET['action']) ? $_GET['action'] : ($_GET['action'] = 'index');
$response = new \lib\Response();
if (method_exists($response, $action)) {
    return call_user_func(array($response, $action));
} else {
    header('HTTP/1.1 404 Not Found');
}