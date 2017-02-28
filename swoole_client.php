<?php

$header = array(
    'GET / HTTP/1.1',
    'Accept: */*',
    'User-Agent: Mozila/4.0(compatible;MSIE5.01;Window NT5.0)',
    'Connection: Keep-Alive',
    'Host: w.qq.com'
);
$message = implode("\r\n", $header) . "\r\n\r\n";
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function(swoole_client $cli)use($message) {
    $cli->send($message);
});
$client->on("receive", function(swoole_client $cli, $data){
    echo "Receive: $data";
    //$cli->send(str_repeat('A', 100)."\n");
    sleep(1);
});
$client->on("error", function(swoole_client $cli){
    echo "error\n";
});
$client->on("close", function(swoole_client $cli){
    echo "Connection close\n";
});
$client->connect('101.227.160.102', 443);