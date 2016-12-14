<?php
/**
 * try{}catch{}的使用测试
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