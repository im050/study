<?php
function __autoload($class) {
	echo $class . "<br/>";
	$file = $_SERVER['DOCUMENT_ROOT'] . "/" . $class . '.php';
	echo $file . "<br/>";
}