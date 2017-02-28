<?php
/**
 * Autoload函数
 * @param $class
 * 注:当带有namespace时,无法触发autoload
 *    带有namespace时,应该以include方式引入
 * @see namespace_autoload.php
 */
function __autoload($class) {
	echo $class . "<br/>";
	$file = $_SERVER['DOCUMENT_ROOT'] . "/" . $class . '.php';
	echo $file . "<br/>";
}