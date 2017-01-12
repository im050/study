<?php

$a = 1;
$b = &$a;
$b = 5;
unset($b);
echo $a;
?>