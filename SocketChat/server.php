<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/16
 * Time: 下午12:27
 */

$socket = stream_socket_server("tcp://0.0.0.0:9801");

$base = event_base_new();
$event = event_new();

event_set($event, $socket, EV_READ | EV_PERSIST, 'ev_accept', array($event, $base));
event_base_set($event, $base);
event_add($event);
event_base_loop($base);

$sockets = [];

function ev_accept($socket, $event, $args)
{
    global $sockets;
    $base = $args[1];
    $connection = stream_socket_accept($socket);
    stream_set_blocking($connection, 0);
    $sockets[] = $connection;
    $ev_read = event_new();
    event_set($ev_read, $connection, EV_READ | EV_PERSIST, 'ev_read', array($ev_read, $base));
    event_base_set($ev_read, $base);
    event_add($ev_read);
}

function ev_read($connection, $event, $args)
{
    global $sockets;
    $read = stream_socket_recvfrom($connection, 1024);
    foreach ($sockets as $socket) {
        if ($socket != $connection) {
            fwrite($socket, $read);
        }
    }
}