<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/14
 * Time: 上午11:33
 */

$string = "Windows 95";


preg_match('/win/i', $string, $matches);

print_r($matches);