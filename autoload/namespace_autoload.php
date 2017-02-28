<?php

namespace test\index;
echo "go";
include('autoload.php');
echo "end";
$a = new \test\foo\Foo();
echo "bottom";

?>