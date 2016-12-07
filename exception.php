<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/5
 * Time: 下午6:00
 */
function foo() {
    throw new Exception("test foo");
}

function foo2() {
    try {
        throw new Exception("GG");
        foo();
    } catch(Exception $e) {
        echo "THIS WAY CATCH GG!!";
        throw $e;
    }
}

try {
    foo2();
} catch(Exception $e) {
    echo "异常:".$e->getMessage();
}