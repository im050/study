<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 80, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
$client->send("GET / HTTP/1.1\n");
echo $client->recv();
$client->close();