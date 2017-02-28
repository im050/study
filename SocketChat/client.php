<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/16
 * Time: 上午11:56
 */

$socket = stream_socket_client("tcp://127.0.0.1:9801");
$pid = pcntl_fork();
if ($pid == 0) {
    //子进程负责读
    while(true) {
        while(($read = stream_socket_recvfrom($socket, 1024))) {
            echo $read;
        }
    }
} else if ($pid > 0) {
    //父进程负责写
    $input = STDIN;
    while($input) {
        $text = fgets($input);
        if (!empty(trim($text))) {
            if (stream_socket_sendto($socket, $text) === -1) {
                echo "error";
            }
        }
    }
} else if ($pid == -1) {
    exit("fork failed");
}